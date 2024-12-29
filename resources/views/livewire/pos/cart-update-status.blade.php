<?php

use App\Models\PaymentMethod;
use App\Models\User;

use function Livewire\Volt\{state, computed, mount};

state([
    'status' => auth()->user()?->cart?->status,
    'vendor_id' => auth()->user()?->cart?->vendor_id,
    'due_date' => auth()->user()?->cart?->due_date,
]);

$vendors = computed(function () {
    return User::where('role', 'vendor')->get();
});


$save = function () {
    auth()->user()->cart->update([
        'status' => $this->status
    ]);

    $this->redirect(route('pos'), navigate: true);
};

$updateVendor = function () {
    auth()->user()->cart->update([
        'vendor_id' => $this->vendor_id ?? null,
    ]);

    $this->redirect(route('pos'), navigate: true);
};

$updateDueDate = function () {
    auth()->user()->cart->update([
        'due_date' => $this->due_date ?? null,
    ]);

    $this->redirect(route('pos'), navigate: true);
};

?>

<div class="flex gap-4">
    <div class="space-y-1 w-full">
        <x-input-label for="status" value="{{ __('Status') }}" />
        <select name="status"
            wire:model="status"
            wire:change="save()"
            class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
            >
            <option value="paid">{{ __('paid')}}</option>
            <option value="pending">
                <p class="text-amber-500">{{ __('pending order') }}</p>
            </option>
            <option value="credit">
                <p class="text-rose-500">{{ __('credit sale') }}</p>
            </option>
        </select>
    </div>

    @if ($status == 'pending')
        <div class="space-y-1 w-full text-amber-500" wire:transition>
            <x-input-label for="vendor" value="{{ __('Vendor') }}" />
            <select name="vendor_id"
                wire:model="vendor_id"
                wire:change="updateVendor()"
                class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
            >
                <option value="">{{ __('Select vendor')}}</option>
                @foreach ($this->vendors as $vendor)
                  <option wire:key="$vendor->id" value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if ($status == 'credit')
        <div class="space-y-1 w-full text-amber-500" wire:transition>
            <x-input-label for="due_date" value="{{ __('Due date') }}" />
            <x-text-input type="date"
                          wire:model="due_date"
                          wire:change="updateDueDate()" />
        </div>
    @endif

</div>
