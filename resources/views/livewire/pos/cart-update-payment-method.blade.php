<?php

use App\Models\PaymentMethod;

use function Livewire\Volt\{state, computed, mount};

state([
    'payment_method_id' => auth()->user()?->cart?->payment_method_id,
]);

$paymentMethods = computed(function () {
    return PaymentMethod::get();
});

$save = function () {
    auth()->user()->cart->update([
        'payment_method_id' => $this->payment_method_id
    ]);

    $this->payment_method_id = auth()->user()?->cart?->payment_method_id;

    $this->redirect(route('pos'), navigate: true);
};

?>

<div>
    <x-input-label for="name" value="{{ __('Payment method') }}" />

    <select name="payment_method_id" 
            wire:model.live="payment_method_id"
            wire:change="save"
            class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
            >
        <option value="" @if($payment_method_id) {{'disabled'}} @endif>{{ __('Select payment method')}}</option>
        @foreach ($this->paymentMethods as $paymentMethod)
            <option wire:key="$paymentMethod->id" value="{{ $paymentMethod->id }}" @selected($paymentMethod->name) == "cash">{{ $paymentMethod->name }}</option>
        @endforeach
    </select>
</div>
