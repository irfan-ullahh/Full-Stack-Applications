<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Get current session ID before logout
        $sessionId = session()->getId();
        
        // Remove user_id from session record
        DB::table('sessions')
            ->where('id', $sessionId)
            ->update(['user_id' => null]);
        
        // Logout the user
        Auth::logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        
        // Regenerate CSRF token
        $request->session()->regenerateToken();
        
        // Redirect to login page with message
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}