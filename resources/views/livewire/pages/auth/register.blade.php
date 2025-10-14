<?php

use App\Models\Role;
use App\Models\User;
use App\RoleEnum;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public bool $terms = false;
//    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', Rules\Password::defaults()],
            'terms' => ['required', 'boolean'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = Role::firstWhere('name', RoleEnum::User->value)->id;

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect('/');
    }
}; ?>

<x-slot:title>Register</x-slot>
<div>
    <form class="my-4" wire:submit="register">
        <div class="form-group mb-3">
            <label for="username" class="form-label">Name</label>
            <input class="form-control" name="name" type="text" id="name" placeholder="Enter your name"
                   wire:model="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <div class="form-group mb-3">
            <label for="emailaddress" class="form-label">Email address</label>
            <input class="form-control" type="email" id="emailaddress" placeholder="Enter your email"
                   wire:model="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="form-group mb-3">
            <label for="register-password" class="form-label">Password</label>
            <div class="input-group">
                <input class="form-control" type="password" id="register-password" placeholder="Enter your password"
                       wire:model="password">
                <span class="input-group-text" onclick="onRegisterPasswordVisible()" style="cursor: pointer">
                    <i class="mdi mdi-lock-outline fs-16 align-middle" id="register-lock-icon"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="form-group d-flex mb-3">
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox-signin" wire:model="terms">
                    <label class="form-check-label" for="checkbox-signin">I agree to the <a href="#"
                                                                                            class="text-primary fw-medium">
                            Terms and Conditions</a></label>
                </div>
            </div><!--end col-->
        </div>

        <div class="form-group mb-0 row">
            <div class="col-12">
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit"> Register <span
                            class="spinner-grow spinner-grow-sm" aria-hidden="true"
                            wire:loading></span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="saprator my-4"><span>or sign in with</span></div>

    <div class="text-center text-muted mb-4">
        <p class="mb-0">Already have an account ?<a class='text-primary ms-2 fw-medium' href='/login' wire:navigate>Login
                here</a></p>
    </div>
</div>


{{--<div>--}}
{{--    <form wire:submit="register">--}}
{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</div>--}}
