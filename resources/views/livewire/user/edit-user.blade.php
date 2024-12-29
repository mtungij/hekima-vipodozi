<div class="space-y-6">
    <button
         x-data=""
         x-on:click.prevent="$dispatch('open-modal', 'update-user-modal{{ $form->user->id }}')"
    >
        <x-heroicon-o-pencil-square class="size-5 text-teal-500" />
    </button>

    <x-modal name="update-user-modal{{ $form->user->id }}" :show="$errors->isNotEmpty()" maxWidth="4xl" focusable>
        <form wire:submit="updateUser" class="p-3 lg:p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Update user') }}
            </h2>

            <div class="mt-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <x-input-label for="name" value="{{ __('Full name') }}" />
    
                    <x-text-input
                        wire:model="form.name"
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="{{ __('') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="branch_id" value="{{ __('Branch') }}" />
    
                    <select name="branch_id" 
                            wire:model="form.branch_id"
                            class="py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                            >
                        <option value="">{{ __('Select branch')}}</option>
                        @foreach ($branches as $branch)
                            <option wire:key="$branch->id" value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('form.branch_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="role" value="{{ __('Permission/role') }}" />
    
                    <select name="role" 
                            wire:model="form.role"
                            id="role"
                            class="py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                            >
                        <option value="">{{ __('Select role')}}</option>
                        <option value="admin">{{ __('Admin')}}</option>
                        <option value="manager">{{ __('Manager')}}</option>
                        <option value="seller">{{ __('Seller')}}</option>
                        <option value="vendor">{{ __('Vendor')}}</option>
                        <option value="store_keeper">{{ __('Store Keeper')}}</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.role')" class="mt-2" />
                </div>
            </div>



            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Update user') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
