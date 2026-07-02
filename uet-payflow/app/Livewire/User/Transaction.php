<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction as TransactionModel;

class Transaction extends Component
{
    public $transactions;
    public $user;
    
    // Stats properties
    public $totalDeposits = 0;
    public $totalTransfers = 0;
    public $totalTransactions = 0;

    public function mount()
    {
        $this->user = Auth::user();
        
        $this->transactions = TransactionModel::with('receiver')
            ->where(function($query) {
                $query->where('sender_id', $this->user->id)
                    ->orWhere('receiver_id', $this->user->id);
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        $this->calculateStats();
    }
    
    public function calculateStats()
    {
        $userId = $this->user->id;
        
        $this->totalDeposits = TransactionModel::where('receiver_id', $userId)
            ->where('type', 'deposit')
            ->where('status', 'success')
            ->sum('amount');
        $this->totalTransfers = TransactionModel::where('sender_id', $userId)
            ->where('status', 'success')
            ->where('type', 'transfer') // Only transfers, not deposits
            ->sum('amount');
        
        $this->totalTransactions = TransactionModel::where(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->where('status', 'success')
            ->count();
    }
    
    public function render()
    {
        return view('livewire.user.transaction', [
            'transactions' => $this->transactions,
            'user' => $this->user,
            'totalDeposits' => $this->totalDeposits,
            'totalTransfers' => $this->totalTransfers,
            'totalTransactions' => $this->totalTransactions,
        ])->layout('livewire.user.main');
    }
}