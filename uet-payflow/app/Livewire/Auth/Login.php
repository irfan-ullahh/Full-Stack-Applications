<?php

namespace App\Livewire\Auth;

use App\Models\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $registration = 'bf25pwcs1700';

    public $pin = '1234';

    public $error = '';

    public $success = '';

    protected $rules = [
        'registration' => 'required|string|exists:users,registration_number',
        'pin' => 'required|string|size:4',
    ];

    protected $messages = [
        'registration.required' => 'Registration number is required',
        'registration.exists' => 'This registration number does not exist',
        'pin.required' => 'PIN is required',
        'pin.size' => 'PIN must be 4 digits',
    ];

    public function login()
    {
        $this->validate();

        $user = User::where('registration_number', $this->registration)->first();

        if ($user && Hash::check($this->pin, $user->pin)) {

            if ($user->status !== 'active') {
                $this->error = 'Your account is suspended. Please contact admin.';

                return;
            }

            // Login the user
            Auth::login($user, true);

            // Regenerate session
            session()->regenerate();

            $sessionId = session()->getId();
            if ($sessionId) {
                $db_session = Session::where('user_id', $user->id)->first();  // Use $user->id

                if ($db_session) {
                    $db_session->payload = base64_encode(serialize(session()->all()));
                    $db_session->last_activity = time();
                    $db_session->ip_address = request()->ip();
                    $db_session->user_agent = request()->userAgent();
                    $db_session->save();
                } else {
                    Session::create([
                        'id' => $sessionId,
                        'user_id' => $user->id,
                        'payload' => base64_encode(serialize(session()->all())),
                        'last_activity' => time(),
                        'ip_address' => request()->ip(),
                        'user_agent' => request()->userAgent(),
                    ]);
                }
            }

            return redirect()->route('user.dashboard')->with('success', 'Welcome back, '.$user->full_name.'!');
        }

        $this->error = 'Invalid registration number or PIN';
        $this->reset(['pin']);
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('livewire.auth.main');
    }
}
