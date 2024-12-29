<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Sustem users')}}
        </h2>
    </x-slot>

    <div class="py-6">
        <livewire:user.all-users />
    </div>
</div>
