<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Transaction;

class Deposit extends Component
{
    public $amount = '';
    public $pin = '';
    public $error = '';
    public $success = '';
    public $isProcessing = false;
    public $available_balance = 0;
    public $totalDeposits = 0;
    
    // Modal properties
    public $showSuccessModal = false;
    public $lastTransactionId = '';
    public $lastAmount = 0;
    public $newBalance = 0;
    public $transactionDate = '';

    protected $rules = [
        'amount' => 'required|numeric|min:100|max:100000',
        'pin' => 'required|string|size:4',
    ];

    protected $messages = [
        'amount.required' => 'Please enter an amount',
        'amount.numeric' => 'Amount must be a number',
        'amount.min' => 'Minimum deposit amount is Rs. 100',
        'amount.max' => 'Maximum deposit amount is Rs. 100,000',
        'pin.required' => 'Please enter your PIN',
        'pin.size' => 'PIN must be 4 digits',
    ];

    public function mount()
    {
        $this->refreshBalance();
        $this->calculateTotalDeposits();
    }

    public function refreshBalance()
    {
        $user = Auth::user();
        $freshUser = User::find($user->id);
        $this->available_balance = $freshUser ? $freshUser->wallet_balance : 0;
    }

    public function calculateTotalDeposits()
    {
        $userId = Auth::id();
        
        $this->totalDeposits = Transaction::where('receiver_id', $userId)
            ->where('type', 'deposit')
            ->where('status', 'success')
            ->sum('amount');
    }

    public function addAmount($value)
    {
        $this->amount = $value;
        $this->clearMessages();
    }

    public function clearMessages()
    {
        $this->error = '';
        $this->success = '';
    }

    public function closeModal()
    {
        $this->showSuccessModal = false;
        $this->reset(['amount', 'pin']);
    }

    public function deposit()
    {
        $this->clearMessages();
        $this->isProcessing = true;
        
        // Validate input
        $this->validate();

        $user = Auth::user();
        $systemUser = User::find(1); // SYSTEM account

        // Verify PIN
        if (!Hash::check($this->pin, $user->pin)) {
            $this->error = 'Invalid PIN. Please enter correct 4-digit PIN';
            $this->isProcessing = false;
            return;
        }

        // Check if system account exists
        if (!$systemUser) {
            $this->error = 'System error: Please contact administrator';
            $this->isProcessing = false;
            return;
        }

        try {
            // Start Transaction - ATOMICITY
            DB::beginTransaction();

            // Lock rows for update - ISOLATION
            $user = User::where('id', $user->id)->lockForUpdate()->first();
            $systemUser = User::where('id', 1)->lockForUpdate()->first();

            // Store old balances for audit - CONSISTENCY
            $oldUserBalance = $user->wallet_balance;
            $oldSystemBalance = $systemUser->wallet_balance;

            // Update balances
            $user->wallet_balance += $this->amount;
            $systemUser->wallet_balance -= $this->amount;

            // Save changes - DURABILITY
            $user->save();
            $systemUser->save();

            // Create transaction record
            $transaction = Transaction::create([
                'sender_id' => $systemUser->id,
                'receiver_id' => $user->id,
                'type' => 'deposit',
                'amount' => $this->amount,
                'status' => 'success',
                'failure_reason' => null,
            ]);

            // Create audit log
            DB::table('audit_logs')->insert([
                'transaction_id' => $transaction->id,
                'old_balance_sender' => $oldSystemBalance,
                'new_balance_sender' => $systemUser->wallet_balance,
                'old_balance_receiver' => $oldUserBalance,
                'new_balance_receiver' => $user->wallet_balance,
                'performed_by' => $user->registration_number,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Commit transaction
            DB::commit();

            // Refresh balance
            $this->refreshBalance();
            $this->calculateTotalDeposits();
            
            // Set modal data
            $this->lastTransactionId = 'TXN-' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT);
            $this->lastAmount = $this->amount;
            $this->newBalance = $this->available_balance;
            $this->transactionDate = now()->format('d M Y, h:i A');
            
            // Show success modal
            $this->showSuccessModal = true;
            $this->reset(['amount', 'pin']);
            
            // Dispatch event to update other components
            $this->dispatch('balance-updated', newBalance: $this->available_balance);

        } catch (\Exception $e) {
            // Rollback on error - ATOMICITY
            DB::rollBack();
            
            // Record failed transaction
            Transaction::create([
                'sender_id' => 1,
                'receiver_id' => $user->id,
                'type' => 'deposit',
                'amount' => $this->amount,
                'status' => 'failed',
                'failure_reason' => $e->getMessage(),
            ]);
            
            $this->error = 'Deposit failed: ' . $e->getMessage();
           
        } finally {
            $this->isProcessing = false;
        }
    }

    public function goToDashboard()
    {
        $this->showSuccessModal = false;
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.user.deposit', [
            'available_balance' => $this->available_balance,
            'totalDeposits' => $this->totalDeposits,
            'showSuccessModal' => $this->showSuccessModal,
            'lastTransactionId' => $this->lastTransactionId,
            'lastAmount' => $this->lastAmount,
            'newBalance' => $this->newBalance,
            'transactionDate' => $this->transactionDate,
        ])->layout('livewire.user.main');
    }
}