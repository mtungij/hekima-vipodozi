<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Customers')}}
        </h2>
    </x-slot>

    <div class="py-6">
        <livewire:customer.all-customers />
    </div>
</div>
