<div>
    <div class="grid gap-4 p-2 md:p-8 ">
        <div>
            <a href="{{ route('products')}}" wire:navigate>
                <x-secondary-button>
                    <x-heroicon-m-arrow-left-circle class="size-4 mr-2" />
                    {{ __('Back to products') }}
                </x-secondary-button>
            </a>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Import products from other branch') }}
            </h2>
        </div>

        <select name="branch_id" 
                wire:model.live="branch_id"
                class="py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                >
            <option value="">{{ __('Select branch')}}</option>
            @foreach ($branches as $branch)
                <option wire:key="$branch->id" value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
        </select>

        <div class="flex gap-4 justify-between items-center">
            <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search product ..." />
            <x-secondary-button wire:click="importAllProducts()" 
                                title="{{ __('Import all products from the selected branch')}}"
                                wire:confirm="Are you sure you want to import all these products?"
                >
                <x-heroicon-o-document-arrow-down class="size-5 mr-2" />
                <span class="hidden md:inline">{{ _('Import all products')}}</span>
            </x-secondary-button>
        </div>

        <div class="space-y-4 overflow-x-auto bg-white dark:bg-transparent whitespace-nowrap">
            <table class="w-full border-collapse border dark:border-gray-700">
                <thead class="dark:text-gray-300">
                    <tr>
                        <th class="p-2 text-xs text-left uppercase border dark:border-gray-700">{{__('Name')}}</th>
                        <th class="p-2 text-xs text-left border dark:border-gray-700"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 dark:text-gray-400">
                @foreach ($this->products as $product)
                    <tr wire:key="{{ $product->id }}" class="transition-colors {{ auth()->user()->product_id == $product->id ? 'bg-gray-200/90 dark:bg-gray-700/50': ''}} hover:bg-gray-200/90 dark:hover:bg-gray-700/50">
                        <td class="p-2 text-sm text-left border dark:border-gray-700">{{ $product->name }}</td>
                        <td class="p-2 text-sm border dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                <button wire:click="importProduct({{$product->id}})" class="text-teal-500 underline underline-offset-4">{{ __('Import') }}</button>
                                
                                @if (auth()->user()->product_id == $product->id)
                                    <x-heroicon-m-rss class="size-5 text-green-500" />
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @empty($this->products->items())
               <x-empty>{{__('No products to import!')}}</x-empty>
            @endempty
        </div>
        <div class="my-2">
            {{ $this->products()->links() }}
        </div>
    </div>

    <div class="flex justify-center mb-6">
        <a href="{{ route('products')}}" wire:navigate>
            <x-secondary-button>
                <x-heroicon-m-arrow-left-circle class="size-4 mr-2" />
                {{ __('Back to products') }}
            </x-secondary-button>
        </a>
    </div>
</div>

