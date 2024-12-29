<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Inventory System')}}
        </h2>
    </x-slot>

    <section>
        <div class="sm:px-6 lg:px-4 space-y-6">
            <div class="my-2 space-y-4">
                <div class="flex justify-between gap-4">
                    <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search product ..." />
                    
                    <div class="flex items-center gap-4">
                        <x-text-input type="date" name="from_date" wire:model.live.debounce.1000ms="from_date" />
                        <x-text-input type="date" name="to_date" wire:model.live.debounce.1000ms="to_date" />
                    </div>
                </div>
        
                <div class="grid grid-cols-1 lg:grid-cols-2 justify-between gap-4">
                    <p>All products</p>
        
                    <div class="flex items-center shrink-0 gap-4 lg:justify-end">
                        {{-- <livewire:products.filters.filter-product-by-branch /> --}}
                        
        
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-icon-button class="p-0.5" title="{{ __('Import products from another branch')}}">
                                    <x-heroicon-o-folder-arrow-down class="size-6" />
                                </x-icon-button>
                            </x-slot>
        
                            <x-slot name="content">
                                <button>
                                    <x-dropdown-link class="w-full text-start" :href="route('import-product-from-branch')">
                                        <x-heroicon-m-arrow-right-circle class="size-4 mr-2" />
                                        {{ __('Import from branch') }}
                                    </x-dropdown-link>
                                </button>
        
                                <!-- Authentication -->
                                <button wire:confirm="We are working on this feature." class="w-full text-start">
                                    <x-dropdown-link>
                                        <x-heroicon-m-document-text class="size-4 text-teal-400 mr-2" />
                                        {{ __('Import from excel') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
            <div class="md__table_wrapper" wire:lazy>
                <table class="md__table">
                    <thead class="md__thead">
                        <tr class="z-10 sticky top-18">
                            <th class="md__th md__th1">S/N</th>
                            <th class="md__th text-left">{{__('Name')}}</th>
                            <th class="md__th text-right" title="Current stock">{{__('C.stock')}}</th>
                            <th class="md__th text-right" title="New stock">{{__('Added')}}</th>
                            <th class="md__th text-right" title="capital">{{__('Capital')}}</th>
                            <th class="md__th text-right" title="sales count">{{__('S.count')}}</th>
                            <th class="md__th text-right" title="sales quantity">{{__('Out')}}</th>
                            <th class="md__th text-right" title="sales total">{{__('Sales total')}}</th>
                            <th class="md__th text-right" title="Average sales quantity">{{ __('A.S.Qty')}}</th>
                            <th class="md__th text-right" title="Average sales total">{{ __('A.S.Total')}}</th>
                            {{-- <th class="md__th text-right" title="Transfered products">{{ __('Transfers')}}</th> --}}
                            <th class="md__th text-right" title="Prev stock">{{ __('Prev Stock')}}</th>
                        </tr>
                    </thead>
                    <tbody class="md__tbody">
                        @php
                        $rowId = 1;
                        @endphp
                        @foreach ($this->products as $product)
                            <tr wire:key="{{ $product->id }}" class="md__tr">
                                <td class="md__td md__td1">{{ $rowId++ }}</td>
                                <td class="md__td">{{ $product->name }}</td>
                                <td class="md__td text-right">{{ number_format($product->stock) }}</td>
                                <td class="md__td text-right">{{ number_format($product->new_stock_items_sum_stock, 2) }}</td>
                                <td class="md__td text-right">{{ number_format($product->buy_price * $product->stock,2) }}</td>
                                <td class="md__td text-right">{{ number_format($product->order_items_count, 2) }}</td>
                                <td class="md__td text-right">{{ number_format($product->order_items_sum_qty, 2) }}</td>
                                <td class="md__td text-right">{{ number_format($product->order_items_sum_total, 2) }}</td>
                                <td class="md__td text-right">{{ number_format($product->order_items_avg_qty, 2) }}</td>
                                <td class="md__td text-right">{{ number_format($product->order_items_avg_total, 2) }}</td>
                                <td class="md__td text-right">{{ number_format($product->stock + $product->order_items_sum_qty + $product->stock_transfer_items_sum_stock, 2) }}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                @empty($this->products->items())
                <x-empty>{{__('No products found!')}}</x-empty>
                @endempty
            </div>
            <div class="my-2">
                {{ $this->products->links()}}
            </div>
        </div>
    </section>


</div>

