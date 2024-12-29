<section>
    <div class="grid grid-cols-2 divide-x-2 text-white -mx-4">
        <a class="bg-gray-500 py-2 pl-2 lg:pl-6 " href="{{ route('stock-transfer')}}"
           wire:navigate
        >{{ __('Transfer')}}</a>
        <a class="bg-gray-600 p-2" href="{{ route('stock-transfer.transfered')}}"
           wire:navigate
            >{{ __('Transfered')}}</a>
    </div>
    <div class="sm:px-6 lg:px-4 space-y-6">
        <div class="my-2 space-y-4">
            <div class="flex justify-between gap-4">
                <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search product ..." />
                
            </div>
    
            <div class="grid grid-cols-1 lg:grid-cols-2 justify-between gap-4">
                <div class="flex shrink-0 items-center gap-3 overflow-y-auto whitespace-nowrap">
                    <button class="rounded-2xl cursor-pointer select-none dark:text-gray-950 bg-green-400 px-4 py-1 text-sm">
                       All transfers. {{ number_format($transfers->total()) }}
                    </button>
                </div>

                <div class="flex items-center shrink-0 gap-4 lg:justify-end">
                    <x-text-input type="date" wire:model.live.debounce.1000ms="date" />
                    

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-icon-button class="p-0.5" title="{{ __('Import transfers from another branch')}}">
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
                <thead class="md__table">
                    <tr class="z-10">
                        <th class="md__th text-left md__th1">S/N</th>
                        <th class="md__th text-left">{{__('From branch')}}</th>
                        <th class="md__th text-left">{{__('To branch')}}</th>
                        <th class="md__th text-left">{{__('Items')}}</th>
                        <th class="md__th text-left">{{__('Status')}}</th>
                        <th class="md__th text-left">{{__('Date')}}</th>
                        <th class="md__th"></th>
                    </tr>
                </thead>
                <tbody class="md__tbody">
                    @php
                    $rowId = 1;
                    @endphp
                    @foreach ($transfers as $transfer)
                        <tr wire:key="{{ $transfer->id }}" class="md__tr">
                            <td class="md__td md__td1"">{{ $rowId++ }}</td>
                            <td class="md__td">
                                    {{ $transfer?->branch?->name }}
                            </td>
                            <td class="md__td">{{ $transfer?->toBranch?->name }}</td>
                            <td class="md__td">{{ number_format($transfer?->stock_transfer_items_count, 2) }}</td>
                            <td class="md__td">{{ $transfer?->status }}</td>
                            <td class="md__td">{{ date('d/m/Y H:m', strtotime($transfer->created_at)) }}</td>
                            <td class="md__td">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('stock-transfer.preview', $transfer->id)}}"
                                       title="View products"
                                       wire:navigate >
                                        <x-heroicon-o-eye class="size-6  hover:fill-current" />
                                    </a>
                                    <button wire:click="delete({{$transfer->id}})" 
                                            wire:confirm="Are you sure that you want to delete this?"
                                    >
                                        <x-heroicon-o-trash class="size-6 hover:fill-current" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @empty($transfers->items())
            <x-empty>{{__('No transfers found!')}}</x-empty>
            @endempty
        </div>
        <div class="my-2">
            {{ $transfers->links()}}
        </div>
    </div>
</section>

