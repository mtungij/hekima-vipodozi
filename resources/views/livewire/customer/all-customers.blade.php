<section>
    <div class="sm:px-6 lg:px-4 space-y-6">
        <div class="my-2 space-y-4">
            <div class="flex justify-between gap-4">
                <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search product ..." />
                
                <x-primary-button>Create customer</x-primary-button>
            </div>
    
            <div class="grid grid-cols-1 lg:grid-cols-2 justify-between gap-4">
                <div class="flex shrink-0 items-center gap-3 overflow-y-auto whitespace-nowrap">
                    <button class="rounded-2xl cursor-pointer select-none dark:text-gray-950 bg-green-400 px-4 py-1 text-sm">
                       All customers. {{ number_format($total) }}
                    </button>
                </div>

                {{-- <div class="flex items-center shrink-0 gap-4 lg:justify-end">
                    <x-secondary-button>Filter by branch</x-secondary-button>
                    

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-icon-button class="p-0.5" title="{{ __('Import customers from another branch')}}">
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
                </div> --}}
            </div>
        </div>
        <div class="md__table_wrapper" wire:lazy>
            <table class="md__table">
                <thead class="md__table">
                    <tr class="z-10">
                        <th class="md__th text-left md__th1">S/N</th>
                        <th class="md__th text-left">{{__('Name')}}</th>
                        <th class="md__th text-left">{{__('Contact')}}</th>
                        <th class="md__th text-left">{{__('Date')}}</th>
                        <th class="md__th"></th>
                    </tr>
                </thead>
                <tbody class="md__tbody">
                    @php
                    $rowId = 1;
                    @endphp
                    @foreach ($this->customers as $customer)
                        <tr wire:key="{{ $customer->id }}" class="md__tr">
                            <td class="md__td md__td1"">{{ $rowId++ }}</td>
                            <td class="md__td">
                                    {{ $customer->name }}
                            </td>
                            <td class="md__td">{{ $customer->contact ?? "-" }}</td>
                            <td class="md__td">{{ date('d/m/Y H:m', strtotime($customer->created_at)) }}</td>
                            <td class="md__td">
                                <div class="flex items-center gap-3">
                                    
                                    <button wire:click="deletecustomer({{$customer->id}})" 
                                            wire:confirm.prompt="Are you sure that you want to delete - {{ $customer->name }}?\n\nType DELETE to confirm|DELETE"
                                    >
                                        <x-heroicon-o-trash class="size-5 text-red-500" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @empty($this->customers->items())
            <x-empty>{{__('No customers found!')}}</x-empty>
            @endempty
        </div>
        <div class="my-2">
            {{ $this->customers->links()}}
        </div>
    </div>
</section>

