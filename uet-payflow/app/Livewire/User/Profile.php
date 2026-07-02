<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Profile extends Component
{
    public $user;
    public $sessions = [];
    public $currentSessionId = '';

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadSessions();
    }

    public function loadSessions()
    {
        // Get current session ID
        $this->currentSessionId = session()->getId();
        
        // Get all user sessions from database
        $sessions = DB::table('sessions')
            ->where('user_id', $this->user->id)
            ->orderBy('last_activity', 'desc')
            ->get();
        
        $this->sessions = [];
        
        foreach ($sessions as $session) {
            $deviceInfo = $this->parseUserAgent($session->user_agent);
            
            $this->sessions[] = [
                'id' => $session->id,
                'is_current' => $session->id === $this->currentSessionId,
                'device_name' => $deviceInfo['device'],
                'browser' => $deviceInfo['browser'],
                'platform' => $deviceInfo['platform'],
                'ip_address' => $session->ip_address,
                'last_activity' => $this->getTimeAgo($session->last_activity),
                'location' => $this->getLocationFromIp($session->ip_address),
            ];
        }
    }

    public function removeSession($sessionId)
    {
        // Don't allow removing current session
        if ($sessionId === $this->currentSessionId) {
            session()->flash('error', 'Cannot remove current device');
            return;
        }
        
        // Delete the session from database
        DB::table('sessions')->where('id', $sessionId)->delete();
        
        // Reload sessions
        $this->loadSessions();
        
        session()->flash('success', 'Device removed successfully');
    }

    public function logoutAllOtherDevices()
    {
        // Delete all sessions except current
        DB::table('sessions')
            ->where('user_id', $this->user->id)
            ->where('id', '!=', $this->currentSessionId)
            ->delete();
        
        // Reload sessions
        $this->loadSessions();
        
        session()->flash('success', 'All other devices have been logged out');
    }

    private function parseUserAgent($userAgent)
    {
        $device = 'Unknown Device';
        $browser = 'Unknown';
        $platform = 'Unknown';
        
        if (empty($userAgent)) {
            return ['device' => $device, 'browser' => $browser, 'platform' => $platform];
        }
        
        // Detect device type
        if (str_contains($userAgent, 'iPhone')) {
            $device = 'iPhone';
        } elseif (str_contains($userAgent, 'iPad')) {
            $device = 'iPad';
        } elseif (str_contains($userAgent, 'Android')) {
            if (str_contains($userAgent, 'Mobile')) {
                $device = 'Android Phone';
            } else {
                $device = 'Android Tablet';
            }
        } elseif (str_contains($userAgent, 'Windows')) {
            $device = 'Windows PC';
        } elseif (str_contains($userAgent, 'Macintosh') || str_contains($userAgent, 'Mac OS')) {
            $device = 'Mac';
        } elseif (str_contains($userAgent, 'Linux')) {
            $device = 'Linux PC';
        } elseif (str_contains($userAgent, 'Chrome OS')) {
            $device = 'Chromebook';
        }
        
        // Detect browser
        if (str_contains($userAgent, 'Chrome') && !str_contains($userAgent, 'Edg')) {
            $browser = 'Chrome';
        } elseif (str_contains($userAgent, 'Firefox')) {
            $browser = 'Firefox';
        } elseif (str_contains($userAgent, 'Safari') && !str_contains($userAgent, 'Chrome')) {
            $browser = 'Safari';
        } elseif (str_contains($userAgent, 'Edg')) {
            $browser = 'Edge';
        } elseif (str_contains($userAgent, 'Opera') || str_contains($userAgent, 'OPR')) {
            $browser = 'Opera';
        }
        
        // Detect platform
        if (str_contains($userAgent, 'Windows NT 10.0')) {
            $platform = 'Windows 10';
        } elseif (str_contains($userAgent, 'Windows NT 11.0')) {
            $platform = 'Windows 11';
        } elseif (str_contains($userAgent, 'Mac OS X')) {
            $platform = 'macOS';
        } elseif (str_contains($userAgent, 'Android')) {
            $platform = 'Android';
        } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
            $platform = 'iOS';
        } elseif (str_contains($userAgent, 'Linux')) {
            $platform = 'Linux';
        }
        
        // Combine device and browser for display
        if ($device !== 'Unknown Device' && $browser !== 'Unknown') {
            $device = $device . ' - ' . $browser;
        } elseif ($browser !== 'Unknown') {
            $device = $browser;
        }
        
        return ['device' => $device, 'browser' => $browser, 'platform' => $platform];
    }

    private function getTimeAgo($timestamp)
    {
        $diff = time() - $timestamp;
        
        if ($diff < 60) {
            return 'Just now';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        } else {
            return date('M d, Y', $timestamp);
        }
    }

    private function getLocationFromIp($ip)
    {
        // Simple location mapping based on IP ranges (Pakistan focused)
        if (str_starts_with($ip, '39.32.') || str_starts_with($ip, '39.33.') || 
            str_starts_with($ip, '182.176.') || str_starts_with($ip, '182.177.') ||
            str_starts_with($ip, '119.152.') || str_starts_with($ip, '119.153.')) {
            return 'Lahore, Pakistan';
        } elseif (str_starts_with($ip, '111.68.') || str_starts_with($ip, '111.68.')) {
            return 'Islamabad, Pakistan';
        } elseif (str_starts_with($ip, '127.0.0.1') || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return 'Local Network';
        } elseif ($ip === '::1') {
            return 'Localhost';
        }
        
        return 'Unknown Location';
    }

    public function render()
    {
        return view('livewire.user.profile', [
            'sessions' => $this->sessions,
            'currentSessionId' => $this->currentSessionId,
        ])->layout('livewire.user.main');
    }
}