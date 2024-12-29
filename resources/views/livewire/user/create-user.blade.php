    <div class="space-y-6">
    <x-primary-button
         x-data=""
         x-on:click.prevent="$dispatch('open-modal', 'create-user-modal')"
    >
        <x-heroicon-o-plus class="size-5" />
        <span class="hidden lg:inline-block">{{ __('Create user')}}</span>
    </x-primary-button>

    <x-modal name="create-user-modal" :show="$errors->isNotEmpty()" maxWidth="4xl" focusable>
        <form wire:submit="createUser" class="p-3 lg:p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create new user') }}
            </h2>

            @if ($form->avatar)
            <div class="flex justify-center mt-2">
                <img class="rounded-lg" src="{{ $form->avatar->temporaryUrl() }}">
            </div>
            @endif

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
                    <x-input-label for="email" value="{{ __('Email address') }}" />
    
                    <x-text-input
                        wire:model="form.email"
                        id="email"
                        name="email"
                        type="email"
                        class="mt-1 block w-full"
                        placeholder="{{ __('yourname@gmail.com') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" value="{{ __('Phone number') }}" />
    
                    <x-text-input
                        wire:model="form.phone"
                        id="phone"
                        name="phone"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="{{ __('2557XXXXXXXX') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.phone')" class="mt-2" />
                </div>

                {{-- <div>
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
                </div> --}}

                <div>
                    <x-input-label for="role" value="{{ __('Permission/role') }}" />
    
                    <select name="role" 
                            wire:model="form.role"
                            id="role"
                            class="py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                            >
                        <option value="">{{ __('Select role')}}</option>
                        <option value="admin">{{ __('Admin')}}</option>
                        {{-- <option value="manager">{{ __('Manager')}}</option> --}}
                        <option value="seller">{{ __('Seller')}}</option>
                        {{-- <option value="vendor">{{ __('Vendor')}}</option> --}}
                        {{--<option value="store_keeper">{{ __('Store Keeper')}}</option>--}}
                    </select>
                    <x-input-error :messages="$errors->get('form.role')" class="mt-2" />
                </div>

                 <div>
                    <x-input-label for="avatar" value="{{ __('Profile picture') }}" />
    
                    <x-text-input
                        wire:model="form.avatar"
                        id="avatar"
                        name="avatar"
                        type="file"
                        class="mt-1 block"
                    />
                    <x-input-error :messages="$errors->get('form.avatar')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" value="{{ __('Password') }}" />
    
                    <x-text-input
                        wire:model="form.password"
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full"
                        placeholder="{{ __('******') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" value="{{ __('Confirm password') }}" />
    
                    <x-text-input
                        wire:model="form.password_confirmation"
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        placeholder="{{ __('******') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.password_confirmation')" class="mt-2" />
                </div>
            </div>



            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Create user') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
