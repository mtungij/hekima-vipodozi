<div class="space-y-6">
    <button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'update-product-modal{{ $form?->product?->id }}')"
    >
        <x-heroicon-o-pencil-square class="size-5 text-teal-500" />
    </button>

    <x-modal name="update-product-modal{{ $form?->product?->id }}" :show="$errors->isNotEmpty()" maxWidth="4xl" focusable>
        <form wire:submit="updateProduct" class="p-3 lg:p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Update product') }}
            </h2>

            <p class="mt-1 text-sm text-orange-500">
                {{ __("You're updating product for the branch:") }} <span class="uppercase font-bold text-green-400">{{ auth()->user()?->branch?->name}}</span>
            </p>

            <div class="mt-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <x-input-label for="name" value="{{ __('Product name') }}" />
    
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
                    <x-input-label for="unit" value="{{ __('Unit') }}" />
    
                    <x-text-input
                        wire:model="form.unit"
                        id="unit"
                        name="unit"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="{{ __('each/box/caton') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.unit')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="stock" value="{{ __('Stock') }}" />
    
                    <x-text-input
                        wire:model="form.stock"
                        id="stock"
                        name="stock"
                        type="number"
                        class="mt-1 block w-full"
                        placeholder="{{ __('stock') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.stock')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="buy_price" value="{{ __('Buying price') }}" />
    
                    <x-text-input
                        wire:model="form.buy_price"
                        id="buy_price"
                        name="buy_price"
                        type="number"
                        class="mt-1 block w-full"
                        placeholder="{{ __('Buying price') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.buy_price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="sale_price" value="{{ __('Selling price') }}" />
    
                    <x-text-input
                        wire:model="form.sale_price"
                        id="sale_price"
                        name="sale_price"
                        type="number"
                        class="mt-1 block w-full"
                        placeholder="{{ __('') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.sale_price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="whole_price" value="{{ __('Whole price') }}" />
    
                    <x-text-input
                        wire:model="form.whole_price"
                        id="whole_price"
                        name="whole_price"
                        type="number"
                        class="mt-1 block w-full"
                        placeholder="{{ __('') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.whole_price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="whole_stock" value="{{ __('Whole stock') }}" />
    
                    <x-text-input
                        wire:model="form.whole_stock"
                        id="whole_stock"
                        name="whole_stock"
                        type="number"
                        class="mt-1 block w-full"
                        placeholder="{{ __('') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.whole_stock')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="stock_alert" value="{{ __('Stock alert') }}" />
    
                    <x-text-input
                        wire:model="form.stock_alert"
                        id="stock_alert"
                        name="stock_alert"
                        type="number"
                        class="mt-1 block w-full"
                        placeholder="{{ __('') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.stock_alert')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="expire_date" value="{{ __('Expire date') }}" />
    
                    <x-text-input
                        wire:model="form.expire_date"
                        id="expire_date"
                        name="expire_date"
                        type="date"
                        class="mt-1 block w-full"
                    />
                    <x-input-error :messages="$errors->get('form.expire_date')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="transport" value="{{ __('Transport fee') }}" />
    
                    <x-text-input
                        wire:model="form.transport"
                        id="transport"
                        name="transport"
                        type="number"
                        class="mt-1 block w-full"
                        placeholder="{{ __('') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('form.transport')" class="mt-2" />
                </div>
            </div>



            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Update product') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
