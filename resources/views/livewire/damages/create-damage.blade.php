<?php

use App\Models\Product;
use App\Models\DamageProduct;

use function Livewire\Volt\{state, rules, with};

state([
    'product_id',
    'amount',
    'desc'
]);

rules([
    'product_id' => 'required',
    'amount' => 'required|numeric|max:9999999|min:0',
    'desc' => 'required|string|max:255|min:5'
]);

$store = function () {
    $validated = $this->validate();

    $product = Product::find($this->product_id);

    if($validated['amount'] > $product->stock) {
        session()->flash('error', 'Stock is not enough.');
        $this->redirect(route('damages'), navigate:true);
    } else {
        DamageProduct::create($validated);

        $product->decrement('stock', $validated['amount']);

        session()->flash('success', 'Damage added.');

        $this->reset();
    }


    $this->dispatch('damages-changed');
};

with([
    'products' => Product::get(),
]);


?>

<div class="space-y-6">
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'create-damage-modal')"
    >{{ __('Add damage') }}</x-primary-button>

    <x-modal name="create-damage-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="store" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add damaged product') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('') }}
            </p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="product_id" value="{{ __('Product') }}" />
    
                    <select name="product_id" 
                            wire:model="product_id"
                            class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                            >
                        <option value="">{{ __('Select product')}}</option>
                        @foreach ($products as $product)
                            <option wire:key="$product->id" value="{{ $product->id }}">{{ $product->name }}({{ $product->stock }})</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="amount" value="{{ __('Stock') }}" />
    
                    <x-text-input
                        wire:model="amount"
                        id="amount"
                        name="amount"
                        type="number"
                        class="mt-1 block"
                    />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="desc" value="{{ __('Description') }}" />
    
                    <x-text-input
                        wire:model="desc"
                        id="desc"
                        name="desc"
                        type="text"
                        class="mt-1 block"
                    />
                    <x-input-error :messages="$errors->get('desc')" class="mt-2" />
                </div>
            </div>



            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Add damage') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
