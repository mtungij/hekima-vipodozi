<div class="space-y-6">
    <button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'update-branch-modal{{ $form->branch?->id}}')"
    >
        <x-heroicon-o-pencil-square class="size-5 text-teal-500" />
    </button>

    <x-modal name="update-branch-modal{{ $form->branch?->id}}" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="update" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ "Update  {$form->branch?->name} branch" }}
            </h2>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="name" value="{{ __('Branch name') }}" />
    
                    <x-text-input
                        wire:model="form.name"
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 block"
                        placeholder="{{ __('branch name') }}"
                    />
                    <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" value="{{ __('Branch phone') }}" />
    
                    <x-text-input
                        wire:model="form.phone"
                        id="phone"
                        name="phone"
                        type="text"
                        class="mt-1 block"
                        placeholder="{{ __('2557xxxxxxx') }}"
                    />
                    <x-input-error :messages="$errors->get('form.phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="address" value="{{ __('Address') }}" />
    
                    <x-text-input
                        wire:model="form.address"
                        id="address"
                        name="address"
                        type="text"
                        class="mt-1 block"
                    />
                    <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="taxt_id" value="{{ __('Tax ID') }}" />
    
                    <x-text-input
                        wire:model="form.taxt_id"
                        id="taxt_id"
                        name="taxt_id"
                        type="text"
                        class="mt-1 block"
                    />
                    <x-input-error :messages="$errors->get('form.taxt_id')" class="mt-2" />
                </div>

            </div>



            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Update branch') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>