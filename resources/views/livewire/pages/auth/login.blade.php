<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect('/');
    }
}; ?>

<x-slot:title>Login</x-slot>
<div>
    <form class="my-4" wire:submit="login">
        <div class="form-group mb-3">
            <label for="emailaddress" class="form-label">Email address</label>
            <input class="form-control" type="email" id="emailaddress" placeholder="Enter your email" wire:model="form.email">
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
            <input class="form-control" type="password" id="password" placeholder="Enter your password" wire:model="form.password">
            <span class="input-group-text" onclick="onLoginPasswordVisible()"  style="cursor: pointer">
            <i class="mdi mdi-lock-outline fs-16 align-middle" id="login-lock-icon"></i>
            </span>
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="form-group d-flex mb-3">
            <div class="col-sm-6">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                </div>
            </div>
            <div class="col-sm-6 text-end">
                <a class='text-muted fs-14' href='{{ route('password.request') }}' wire:navigate>Forgot password?</a>
            </div>
        </div>

        <div class="form-group mb-0 row">
            <div class="col-12">
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit"> Log In <span
                            class="spinner-grow spinner-grow-sm" aria-hidden="true"
                            wire:loading></span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="saprator my-4"><span>or sign in with</span></div>

    <div class="text-center text-muted mb-4">
        <p class="mb-0">Don't have an account ?<a class='text-primary ms-2 fw-medium' href='{{ route('register') }}' wire:navigate>Register here</a></p>
    </div>
</div>


{{--<div>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form wire:submit="login">--}}
{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember" class="inline-flex items-center">--}}
{{--                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</div>--}}
