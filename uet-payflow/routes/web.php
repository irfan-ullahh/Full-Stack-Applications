<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Livewire\Auth\{Login, Register};
use App\Livewire\User\{ Dashboard as UserDashboard, Deposit, Transfer, Transaction, Profile, Settings, ProfileEdit};

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('/desposit-funds', Deposit::class)->name('user.deposit');
    Route::get('/transfer-funds', Transfer::class)->name('user.transfer');
    Route::get('/transaction-history', Transaction::class)->name('user.transaction');
    Route::get('/my-profile', Profile::class)->name('user.profile');
    Route::get('/edit-profile', ProfileEdit::class)->name('user.edit-profile');
    Route::get('/settings', Settings::class)->name('user.setting');
});


// routes/web.php
Route::get('/test-session', function () {
    // Get session ID
    $sessionId = session()->getId();
    
    // Check if session exists in database
    $sessionExists = DB::table('sessions')->where('id', $sessionId)->exists();
    
    // Get all sessions
    $allSessions = DB::table('sessions')->get();
    
    return [
        'session_id' => $sessionId,
        'session_exists_in_db' => $sessionExists,
        'total_sessions_in_db' => $allSessions->count(),
        'sessions' => $allSessions,
        'session_driver' => config('session.driver'),
    ];
});
