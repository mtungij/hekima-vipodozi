<div clss="w-full pb-6">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Point of sale(POS)')}}
        </h2>
    </x-slot>

    <div class="">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="relative mt-4 min-h-48 overflow-auto bg-white dark:bg-gray-800">
                <p class="pl-1 font-bold text-white bg-cyan-600" wire:lazy>Cart Items ({{ $totalItems }})</p>
                <livewire:pos.cart-items />
            </div>
            <div class="min-h-48 p-2 bg-white dark:bg-gray-800 sticky top-0 overflow-auto">
                <p class="pl-1 font-bold text-white bg-cyan-600">Products & order details</p>
                <livewire:pos.order-details />
            </div>
        </div>
    </div>
</div>