<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Register extends Component
{
    public $full_name = '';
    public $registration = '';
    public $new_pin = '';
    public $confirm_pin = '';
    public $error = '';
    public $success = '';

    protected $rules = [
        'full_name' => 'required|string|max:100',
        'registration' => 'required|string|max:20|unique:users,registration_number',
        'new_pin' => 'required|string|size:4',
        'confirm_pin' => 'required|string|size:4|same:new_pin',
    ];

    protected $messages = [
        'full_name.required' => 'Full name is required',
        'full_name.max' => 'Full name cannot exceed 100 characters',
        'registration.required' => 'Registration number is required',
        'registration.unique' => 'This registration number already exists',
        'new_pin.required' => 'PIN is required',
        'new_pin.size' => 'PIN must be 4 digits',
        'confirm_pin.required' => 'Please confirm your PIN',
        'confirm_pin.size' => 'Confirm PIN must be 4 digits',
        'confirm_pin.same' => 'PIN and Confirm PIN do not match',
    ];

    public function register()
    {
        $this->validate();

        try {
            // Create new user without email
            $user = User::create([
                'full_name' => $this->full_name,
                'registration_number' => $this->registration,
                'pin' => Hash::make($this->new_pin),
                'wallet_balance' => 0,
                'status' => 'active',
            ]);

            Auth::login($user, true);
            session()->regenerate();
            
            // Update session with user_id
            session()->save();
            $sessionId = session()->getId();
            if ($sessionId) {
                DB::table('sessions')
                    ->where('id', $sessionId)
                    ->update([
                        'user_id' => $user->id,
                        'last_activity' => time(),
                    ]);
            }
            session()->flash('success', 'Welcome to UET PayFlow! Your account has been created successfully.');
                        return $this->redirect(route('user.dashboard'), navigate: true);


        } catch (\Exception $e) {
            $this->error = 'Registration failed: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('livewire.auth.main');
    }
}