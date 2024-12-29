<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('System setup') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-full" wire:lazy>
                <livewire:system-setup.branches />
            </div>

            <div class="max-w-full" wire:lazy>
                <livewire:system-setup.payment-method />
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full" wire:lazy>
                    Company details
                </div>
            </div>
        </div>
    </div>
</div>
