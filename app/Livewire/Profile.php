<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    #[Validate('required|min:3|max:255')]
    public $name;
    #[Validate('email|unique:users,email')]
    public $email;
    #[Validate('min:10|max:13')]
    public $phone;
    #[Validate('image|max:2048|mimes:jpeg,jpg,png,avif,webp')]
    public $image;
    #[Validate('string')]
    public $address;
    public $path;

    public $old_password;
    public $new_password;
    public $confirm_password;

    public $role_email;
    public $role;

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->phone = $this->user?->phone;
        $this->email = $this->user->email;
        $this->address = $this->user?->address;
    }

    public function update()
    {
        if ($this->image) {
            if (config('app.env') === 'local') {
                $this->path = 'storage/' . $this->image->store(path: 'images/profiles');
            } else {
                $this->path = 'storage/app/public' . $this->image->store(path: 'images/profiles');
            }
        }

        $this->user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'image' => $this->path ?: $this->user->image,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Profile updated successfully.');

        $this->redirectRoute('profile');
    }

    public function changePassword()
    {
        if ($this->new_password !== $this->confirm_password) {
            session()->flash('change-error', 'New and Confirm passwords do not match.');
            $this->redirectRoute('profile');
        } else {
            if (Hash::check($this->old_password, $this->user->password)) {
                $this->user->update([
                    'password' => Hash::make($this->new_password),
                ]);

                session()->flash('change-success', 'Password updated successfully.');
                $this->redirectRoute('profile');
            } else {
                session()->flash('change-error', 'Old password does not match.');
                $this->redirectRoute('profile');
            }
        }
    }

    public function changeRole()
    {
        $_user = User::firstWhere('email', $this->role_email);

        if (!$_user) {
            session()->flash('role-error', 'User not found.');
            $this->redirectRoute('profile');
        } else {
            $_user->update([
                'role_id' => Role::where('name', $this->role)->first()->id,
            ]);

            session()->flash('role-success', 'User role updated successfully.');
            $this->redirectRoute('profile');
        }
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
