<?php

// app/Livewire/User/Dashboard.php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $transactions;
    public $user;
    
    // Card 1: Wallet Balance
    public $balance;
    public $weekDeposit = 0;
    public $balancePercentageChange = 0;
    public $lastMonthBalance = 0;
    
    // Card 2: This Month Spent
    public $monthSpent = 0;
    public $monthSpentPercentageChange = 0;
    public $lastMonthSpent = 0;
    public $messFeeThisMonth = 0;
    public $otherSpentThisMonth = 0;
    
    // Card 3: Total Transactions
    public $totalTransactions = 0;
    public $transactionsPercentageChange = 0;
    public $lastMonthTransactions = 0;
    public $pendingTransactions = 0;

    public function mount()
    {
        $this->user = Auth::user();
        $this->balance = $this->user->wallet_balance;
        
        // Get user transactions
        $this->transactions = Transaction::where('sender_id', $this->user->id)
            ->orWhere('receiver_id', $this->user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Calculate all stats
        $this->calculateWalletStats();
        $this->calculateSpendingStats();
        $this->calculateTransactionStats();
    }

    /**
     * Card 1: Wallet Balance Statistics
     */
    public function calculateWalletStats()
    {
        // This week's deposits
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        $this->weekDeposit = Transaction::where('receiver_id', $this->user->id)
            ->where('type', 'deposit')
            ->where('status', 'success')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('amount');
        
        // Last month's balance (ending balance of last month)
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        $this->lastMonthBalance = Transaction::where(function($query) {
                $query->where('sender_id', $this->user->id)
                    ->orWhere('receiver_id', $this->user->id);
            })
            ->where('status', 'success')
            ->where('created_at', '<=', $lastMonthEnd)
            ->orderBy('created_at', 'desc')
            ->first();
        
        // Calculate percentage change
        $oldBalance = $this->lastMonthBalance ? $this->lastMonthBalance->amount : 0;
        if ($oldBalance > 0) {
            $change = (($this->balance - $oldBalance) / $oldBalance) * 100;
            $this->balancePercentageChange = round(abs($change));
        } else {
            $this->balancePercentageChange = $this->balance > 0 ? 100 : 0;
        }
    }

    /**
     * Card 2: This Month Spending Statistics
     */
    public function calculateSpendingStats()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
        
        // This month's spending (sent money, excluding deposits)
        $this->monthSpent = Transaction::where('sender_id', $this->user->id)
            ->where('status', 'success')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');
        
        // Last month's spending
        $this->lastMonthSpent = Transaction::where('sender_id', $this->user->id)
            ->where('status', 'success')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('amount');
        
        // Calculate percentage change
        if ($this->lastMonthSpent > 0) {
            $change = (($this->monthSpent - $this->lastMonthSpent) / $this->lastMonthSpent) * 100;
            $this->monthSpentPercentageChange = round(abs($change));
        } elseif ($this->monthSpent > 0) {
            $this->monthSpentPercentageChange = 100;
        } else {
            $this->monthSpentPercentageChange = 0;
        }
        
        // Mess fee this month (if you have mess fee transactions)
        // Assuming mess fee is stored as 'transfer' to a specific mess account
        $messAccountId = 2; // Change this to your mess account ID
        $this->messFeeThisMonth = Transaction::where('sender_id', $this->user->id)
            ->where('receiver_id', $messAccountId)
            ->where('status', 'success')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');
        
        // Other spending (total spent - mess fee)
        $this->otherSpentThisMonth = $this->monthSpent - $this->messFeeThisMonth;
    }

    /**
     * Card 3: Transaction Statistics
     */
    public function calculateTransactionStats()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
        
        // Total successful transactions
        $this->totalTransactions = Transaction::where(function($query) {
                $query->where('sender_id', $this->user->id)
                    ->orWhere('receiver_id', $this->user->id);
            })
            ->where('status', 'success')
            ->count();
        
        // This month's transactions
        $thisMonthTransactions = Transaction::where(function($query) {
                $query->where('sender_id', $this->user->id)
                    ->orWhere('receiver_id', $this->user->id);
            })
            ->where('status', 'success')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();
        
        // Last month's transactions
        $this->lastMonthTransactions = Transaction::where(function($query) {
                $query->where('sender_id', $this->user->id)
                    ->orWhere('receiver_id', $this->user->id);
            })
            ->where('status', 'success')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->count();
        
        // Calculate percentage change
        if ($this->lastMonthTransactions > 0) {
            $change = (($thisMonthTransactions - $this->lastMonthTransactions) / $this->lastMonthTransactions) * 100;
            $this->transactionsPercentageChange = round(abs($change));
        } elseif ($thisMonthTransactions > 0) {
            $this->transactionsPercentageChange = 100;
        } else {
            $this->transactionsPercentageChange = 0;
        }
        
        // Pending transactions (if any)
        $this->pendingTransactions = Transaction::where(function($query) {
                $query->where('sender_id', $this->user->id)
                    ->orWhere('receiver_id', $this->user->id);
            })
            ->where('status', 'pending')
            ->count();
    }

    public function render()
    {
        return view('livewire.user.dashboard', [
            'user' => $this->user,
            'balance' => $this->balance,
            'transactions' => $this->transactions,
            // Card 1
            'weekDeposit' => $this->weekDeposit,
            'balancePercentageChange' => $this->balancePercentageChange,
            // Card 2
            'monthSpent' => $this->monthSpent,
            'monthSpentPercentageChange' => $this->monthSpentPercentageChange,
            'messFeeThisMonth' => $this->messFeeThisMonth,
            'otherSpentThisMonth' => $this->otherSpentThisMonth,
            // Card 3
            'totalTransactions' => $this->totalTransactions,
            'transactionsPercentageChange' => $this->transactionsPercentageChange,
            'pendingTransactions' => $this->pendingTransactions,
        ])->layout('livewire.user.main');
    }
}