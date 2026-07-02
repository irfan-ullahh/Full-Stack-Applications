<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Settings extends Component
{
    public $current_pin = '';
    public $new_pin = '';
    public $confirm_pin = '';
    public $error = '';
    public $success = '';
    public $isProcessing = false;
    
    // User details
    public $user;
    public $full_name;
    public $registration_number;
    public $email;
    public $wallet_balance;

    protected $rules = [
        'current_pin' => 'required|string|size:4',
        'new_pin' => 'required|string|size:4|different:current_pin',
        'confirm_pin' => 'required|string|size:4|same:new_pin',
    ];

    protected $messages = [
        'current_pin.required' => 'Current PIN is required',
        'current_pin.size' => 'Current PIN must be 4 digits',
        'new_pin.required' => 'New PIN is required',
        'new_pin.size' => 'New PIN must be 4 digits',
        'new_pin.different' => 'New PIN must be different from current PIN',
        'confirm_pin.required' => 'Please confirm your new PIN',
        'confirm_pin.size' => 'Confirm PIN must be 4 digits',
        'confirm_pin.same' => 'New PIN and Confirm PIN do not match',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->full_name = $this->user->full_name;
        $this->registration_number = $this->user->registration_number;
        $this->email = $this->user->email ?? 'Not provided';
        $this->wallet_balance = $this->user->wallet_balance;
    }

    public function clearMessages()
    {
        $this->error = '';
        $this->success = '';
    }

    public function changePin()
    {
        $this->clearMessages();
        $this->isProcessing = true;
        
        $this->validate();

        $user = Auth::user();

        // Verify current PIN
        if (!Hash::check($this->current_pin, $user->pin)) {
            $this->error = 'Current PIN is incorrect';
            $this->isProcessing = false;
            return;
        }

        try {
            // Update PIN
            $user->pin = Hash::make($this->new_pin);
            $user->save();

            $this->success = 'Your PIN has been changed successfully!';
            $this->reset(['current_pin', 'new_pin', 'confirm_pin']);
            
            // Logout user and redirect to login (optional)
            // Auth::logout();
            // return redirect()->route('login')->with('success', 'PIN changed. Please login with new PIN');

        } catch (\Exception $e) {
            $this->error = 'Failed to change PIN: ' . $e->getMessage();
        } finally {
            $this->isProcessing = false;
        }
    }

    public function render()
    {
        return view('livewire.user.settings', [
            'user' => $this->user,
            'full_name' => $this->full_name,
            'registration_number' => $this->registration_number,
            'email' => $this->email,
            'wallet_balance' => $this->wallet_balance,
        ])->layout('livewire.user.main');
    }
}