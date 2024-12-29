<?php

use App\Models\Customer;

use function Livewire\Volt\{state, rules};

state([
    'name' => '',
    'contact',
]);

rules([
    'name' => 'required|string|max:50|min:2',
    'contact' => 'nullable|max:50',
]);

$store = function () {
    $this->validate();

    $customer = Customer::create($this->pull());

    //add customer to the cart
    auth()->user()->cart->update(['customer_id' => $customer->id]);

    session()->flash('sucess', 'Customer created.');

    $this->redirect(route('pos'), navigate: true);
}

?>

<div class="space-y-6">
    <x-primary-button
        x-data=""
        class="w-full text-center"
        x-on:click.prevent="$dispatch('open-modal', 'create-cart-customer-modal')"
    >{{ __('Add customer') }}</x-primary-button>

    <x-modal name="create-cart-customer-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="store" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create new customer ') }}
            </h2>

            <div class="mt-6 grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="name" value="{{ __('Name(full name)') }}" />
    
                    <x-text-input
                        wire:model="name"
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 w-full block"
                        placeholder="{{ __('customer name') }}"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="contact" value="{{ __('Contact') }}" />
    
                    <x-text-input
                        wire:model="contact"
                        id="contact"
                        name="contact"
                        type="text"
                        class="mt-1 w-full block"
                        placeholder="{{ __('phone/email/address...') }}"
                    />
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-start">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>

