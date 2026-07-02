<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Transaction;

class Transfer extends Component
{
    public $recipient_id = '';
    public $amount = '';
    public $pin = '';
    public $error = '';
    public $success = '';
    public $isProcessing = false;
    public $available_balance = 0;
    public $users = [];
    
    // Modal properties
    public $showSuccessModal = false;
    public $lastTransactionId = '';
    public $lastAmount = 0;
    public $newBalance = 0;
    public $transactionDate = '';
    public $recipientName = '';

    protected $rules = [
        'recipient_id' => 'required|exists:users,id',
        'amount' => 'required|numeric|min:1|max:100000',
        'pin' => 'required|string|size:4',
    ];

    protected $messages = [
        'recipient_id.required' => 'Please select a recipient',
        'recipient_id.exists' => 'Selected recipient does not exist',
        'amount.required' => 'Please enter an amount',
        'amount.numeric' => 'Amount must be a number',
        'amount.min' => 'Amount must be at least Rs. 1',
        'amount.max' => 'Amount cannot exceed Rs. 100,000',
        'pin.required' => 'Please enter your PIN',
        'pin.size' => 'PIN must be 4 digits',
    ];

    public function mount()
    {
        $this->loadUsers();
        $this->updateBalance();
    }

    public function loadUsers()
    {
        $this->users = User::where('id', '!=', Auth::user()->id)
            ->where('status', 'active')
            ->orderBy('full_name')
            ->get();
    }

    public function updateBalance()
    {
        $user = Auth::user();
        // Force refresh from database
        $freshUser = User::find($user->id);
        $this->available_balance = $freshUser ? $freshUser->wallet_balance : 0;
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
        $this->reset(['recipient_id', 'amount', 'pin']);
        // Refresh balance when closing modal
        $this->updateBalance();
    }

    public function goToDashboard()
    {
        $this->showSuccessModal = false;
        return redirect()->route('user.dashboard');
    }

    public function transfer()
    {
        $this->clearMessages();
        $this->isProcessing = true;
        
        $this->validate();

        $sender = Auth::user();
        $receiver = User::find($this->recipient_id);

        if ($sender->id == $receiver->id) {
            $this->error = 'You cannot transfer money to yourself';
            $this->isProcessing = false;
            return;
        }

        if ($receiver->status !== 'active') {
            $this->error = 'Recipient account is not active';
            $this->isProcessing = false;
            return;
        }

        if (!Hash::check($this->pin, $sender->pin)) {
            $this->error = 'Invalid PIN. Please enter correct 4-digit PIN';
            $this->isProcessing = false;
            return;
        }

        if ($sender->wallet_balance < $this->amount) {
            $this->error = 'Insufficient balance. Your current balance is Rs. ' . number_format($sender->wallet_balance, 2);
            $this->isProcessing = false;
            return;
        }

        try {
            DB::beginTransaction();

            $sender = User::where('id', $sender->id)->lockForUpdate()->first();
            $receiver = User::where('id', $receiver->id)->lockForUpdate()->first();

            if ($sender->wallet_balance < $this->amount) {
                throw new \Exception('Insufficient balance');
            }

            $oldSenderBalance = $sender->wallet_balance;
            $oldReceiverBalance = $receiver->wallet_balance;

            $sender->wallet_balance -= $this->amount;
            $receiver->wallet_balance += $this->amount;

            $sender->save();
            $receiver->save();

            $transaction = Transaction::create([
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'type' => 'transfer',
                'amount' => $this->amount,
                'status' => 'success',
                'failure_reason' => null,
            ]);

            DB::table('audit_logs')->insert([
                'transaction_id' => $transaction->id,
                'old_balance_sender' => $oldSenderBalance,
                'new_balance_sender' => $sender->wallet_balance,
                'old_balance_receiver' => $oldReceiverBalance,
                'new_balance_receiver' => $receiver->wallet_balance,
                'performed_by' => $sender->registration_number,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            // IMPORTANT: Update the balance FIRST from fresh database query
            $freshSender = User::find($sender->id);
            $this->available_balance = $freshSender->wallet_balance;
            
            // Set modal data with correct new balance
            $this->lastTransactionId = 'TXN-' . str_pad($transaction->id, 6, '0', STR_PAD_LEFT);
            $this->lastAmount = $this->amount;
            $this->newBalance = $freshSender->wallet_balance; // Use fresh balance
            $this->transactionDate = now()->format('d M Y, h:i A');
            $this->recipientName = $receiver->full_name;
            
            // Show success modal
            $this->showSuccessModal = true;
            
            // Reset form
            $this->reset(['recipient_id', 'amount', 'pin']);
            $this->loadUsers();

            $this->dispatch('transfer-completed');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Transaction::create([
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'type' => 'transfer',
                'amount' => $this->amount,
                'status' => 'failed',
                'failure_reason' => $e->getMessage(),
            ]);
            
            $this->error = 'Transfer failed: ' . $e->getMessage();
        } finally {
            $this->isProcessing = false;
        }
    }

    public function render()
    {
        return view('livewire.user.transfer', [
            'users' => $this->users,
            'available_balance' => $this->available_balance,
            'showSuccessModal' => $this->showSuccessModal,
            'lastTransactionId' => $this->lastTransactionId,
            'lastAmount' => $this->lastAmount,
            'newBalance' => $this->newBalance,
            'transactionDate' => $this->transactionDate,
            'recipientName' => $this->recipientName,
        ])->layout('livewire.user.main');
    }
}