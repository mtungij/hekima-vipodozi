<div clss="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            <span class="text-green-500">{{ auth()->user()?->branch?->name }}</span> {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <livewire:products.all-products />
    </div>
</div>

