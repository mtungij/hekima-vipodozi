<?php

use App\Models\OrderItem;
use App\Models\Product;

use function Livewire\Volt\{state, mount, rules};

state([
    'qty' => 0,
    'orderItem' => null,
]);

rules([
    'qty' => "required|numeric|max:999999|min:0",
]);


mount(function (OrderItem $item) {
    $this->qty = $item->qty;
    $this->orderItem = $item;
});

$updateorderItem = function () {
    $this->validate();

    $qty = str_replace(',', '', $this->qty);

    $product = Product::find($this->orderItem->product_id);

    // if qty > v_qty reset qty to 0
    if ($qty > $this->orderItem->v_qty) {
        $this->qty = 0.00;
    } else {
        // otherwise update qty
        $item = $this->orderItem->update(['qty' => $qty]);

        $this->dispatch('item-updated');
    }
}

?>

<div>
    <input type="text" 
        class="py-0.5 px-1 max-w-24 text-right border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
        wire:model.live.debounce.1000ms="qty"
        wire:blur="updateorderItem"
        x-data
        x-mask:dynamic="$money($input)"
        class="max-w-24 py-0" />
    <x-input-error :messages="$errors->get('qty')" class="mt-1" />
</div>
