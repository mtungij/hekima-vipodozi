<div class="space-y-6">
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'create-payment-method-modal')"
    >{{ __('Create payment method') }}</x-primary-button>

    <x-modal name="create-payment-method-modal" :show="$errors->isNotEmpty()" maxWidth="sm" focusable>
        <form wire:submit="store" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create new payment method') }}
            </h2>

            <div class="mt-6 grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="name" value="{{ __('Name') }}" />
    
                    <x-text-input
                        wire:model="name"
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 w-full block"
                        placeholder="{{ __('payment-method name') }}"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
