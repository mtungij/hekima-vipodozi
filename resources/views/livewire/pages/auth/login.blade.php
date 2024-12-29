<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    if(auth()->user()->role == 'admin') {
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    } else {
        $this->redirectIntended(default: route('my-sales', absolute: false), navigate: true);
    }

};

?>

<div class="">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full rounded-3xl" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full rounded-3xl"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-3 items-center mt-4">
            
            <button type="submit" class="ms-3 text-center w-full text-sm px-4 py-2 bg-cyan-800 dark:bg-cyan-600 border border-transparent rounded-3xl text-white tracking-widest hover:bg-cyan-700 dark:hover:bg-cyan-500 focus:bg-cyan-700 dark:focus:bg-cyan-500 active:bg-cyan-900 dark:active:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-cyan-800 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>

           

            <!-- Create Account Button -->
            <a href="{{ route('register') }}" class="ms-3 text-center w-full text-sm px-4 py-2 bg-teal-800 dark:bg-teal-600 border border-transparent rounded-3xl text-white tracking-widest hover:bg-teal-700 dark:hover:bg-teal-500 focus:bg-teal-700 dark:focus:bg-teal-500 active:bg-teal-900 dark:active:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-teal-800 transition ease-in-out duration-150">
                {{ __('Create new Account') }}
            </a>

            <div class="mt-4 flex justify-center">
            <a href="https://wa.me/255629364847?text=Hello%20I%20need%20support%20with%20the%20pharmacy%20system" target="_blank" class="flex items-center text-center px-4 py-2 bg-green-600 rounded-3xl text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            <!-- WhatsApp Icon -->
            <i class="fab fa-whatsapp mr-2"></i> 
            {{ __('Need Support? Chat on WhatsApp') }}
        </a>
    </div>
        </div>
    </form>
</div>

