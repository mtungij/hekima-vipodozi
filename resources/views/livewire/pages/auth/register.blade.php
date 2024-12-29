<?php

use App\Models\User;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => '',
    'company_name' => '',
    'branch_name' => '',
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'company_name' => ['required', 'string', 'max:255'], // Add this rule
    'branch_name' => ['required', 'string', 'max:255'],  // Add this rule
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);



$register = function () {
    $validated = $this->validate();

    $company = Company::create([
        'name' => $this->company_name,
    ]);

    $branch = Branch::create([
        'company_id' => $company->id,
        'name' => $this->branch_name,
    ]);

 
    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password'],
        'branch_id' => $branch->id,
        'company_id' => $company->id,
        'role' => 'admin',
    ])));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    <form wire:submit="register" >
        <!-- Name -->
         
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="company" :value="__('Pharmacy Name')" />
            <x-text-input wire:model="company_name" id="name" class="block mt-1 w-full" type="text" name="name" placeholder="example ABC PHARMACY" required autofocus autocomplete="name" />
             <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="branch" :value="__('Branch Name')" />
            <x-text-input wire:model="branch_name" id="name" class="block mt-1 w-full" type="text" name="name" placeholder="eg MAIN PHARMACY" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('branch_name')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-4 flex justify-center">
        <a href="https://wa.me/255629364847?text=Hello%20I%20need%20support%20with%20the%20pharmacy%20system" target="_blank" class="flex items-center text-center px-4 py-2 bg-green-600 rounded-3xl text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            <!-- WhatsApp Icon -->
            <i class="fab fa-whatsapp mr-2"></i> 
            {{ __('Need Support? Chat on WhatsApp') }}
        </a>
    </div>
    </form>
</div>
