<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The table associated with the model.
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'registration_number',
        'full_name',
        'profile_image',
        'email',
        'phone_number',
        'postal_code',
        'birth_date',
        'department',
        'address',
        'wallet_balance',
        'pin',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'pin',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'wallet_balance' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the identifier for authentication (registration number instead of email).
     */
    public function getAuthIdentifierName()
    {
        return 'registration_number';
    }

    /**
     * Get the password for authentication (PIN instead of password).
     */
    public function getAuthPassword()
    {
        return $this->pin;
    }

    /**
     * Relationships
     */
    public function sentTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_id');
    }

    public function receivedTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }

    public function allTransactions()
    {
        return Transaction::where('sender_id', $this->id)
            ->orWhere('receiver_id', $this->id)
            ->orderBy('created_at', 'desc');
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    /**
     * Helper Methods
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    public function isSystem(): bool
    {
        return $this->id === 1 || $this->registration_number === 'SYSTEM';
    }

    public function getFormattedBalance(): string
    {
        return 'Rs. '.number_format($this->wallet_balance, 2);
    }

    public function getMaskedRegNo(): string
    {
        return substr($this->registration_number, 0, 5).'****';
    }

    public function addFunds(float $amount): void
    {
        $this->wallet_balance += $amount;
        $this->save();
    }

    public function deductFunds(float $amount): void
    {
        if ($this->wallet_balance >= $amount) {
            $this->wallet_balance -= $amount;
            $this->save();
        }
    }

    public function hasSufficientBalance(float $amount): bool
    {
        return $this->wallet_balance >= $amount;
    }
}
