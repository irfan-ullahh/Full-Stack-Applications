<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public $user;
    public $profile_image;
    public $old_profile_image;
    public $full_name;
    public $email;
    public $phone_number;
    public $birth_date;
    public $student_id;
    public $department;
    public $address;
    public $postal_code;
    
    public $error = '';
    public $success = '';
    public $isProcessing = false;

    protected $rules = [
        'full_name' => 'required|string|max:100',
        'email' => 'nullable|email|max:255',
        'phone_number' => 'nullable|string|max:20',
        'birth_date' => 'nullable|date',
        'department' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:500',
        'profile_image' => 'nullable|image|max:2048', // 2MB max
    ];

    protected $messages = [
        'full_name.required' => 'Full name is required',
        'full_name.max' => 'Full name cannot exceed 100 characters',
        'email.email' => 'Please enter a valid email address',
        'email.max' => 'Email cannot exceed 255 characters',
        'phone_number.max' => 'Phone number cannot exceed 20 characters',
        'birth_date.date' => 'Please enter a valid date',
        'department.max' => 'Department cannot exceed 100 characters',
        'address.max' => 'Address cannot exceed 500 characters',
        'profile_image.image' => 'File must be an image',
        'profile_image.max' => 'Image size must be less than 2MB',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->old_profile_image = $this->user->profile_image;
        $this->full_name = $this->user->full_name;
        $this->email = $this->user->email;
        $this->phone_number = $this->user->phone_number;
        $this->birth_date = $this->user->birth_date;
        $this->student_id = $this->user->registration_number;
        $this->department = $this->user->department;
        $this->address = $this->user->address;
        $this->postal_code = $this->user->postal_code;
    }

    public function update_profile()
    {
        $this->clearMessages();
        $this->isProcessing = true;
        
        // Validate input
        $this->validate();

        try {
            $user = Auth::user();
            
            // Handle profile image upload
            if ($this->profile_image) {
                // Delete old image if exists
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }
                
                // Store new image
                $imagePath = $this->profile_image->store('profile-images', 'public');
                $user->profile_image = 'storage/' . $imagePath;
            }
            
            // Update user details
            $user->full_name = $this->full_name;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            $user->birth_date = $this->birth_date;
            $user->department = $this->department;
            $user->address = $this->address;
            $user->postal_code = $this->postal_code;
            
            // Save changes
            $user->save();
            
            // Refresh user data
            $this->user = $user;
            $this->old_profile_image = $user->profile_image;
            
            $this->success = 'Profile updated successfully!';
            
            return $this->redirect(route('user.profile'), navigate: true);
            
        } catch (\Exception $e) {
            $this->error = 'Update failed: ' . $e->getMessage();
        } finally {
            $this->isProcessing = false;
        }
    }

    public function clearMessages()
    {
        $this->error = '';
        $this->success = '';
    }

    public function render()
    {
        return view('livewire.user.profile-edit', [
            'user' => $this->user,
        ])->layout('livewire.user.main');
    }
}