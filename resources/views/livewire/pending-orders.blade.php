<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Pending orders')}}
        </h2>
    </x-slot>

    <section>
        <div class="sm:px-6 lg:px-4 space-y-6">
            <div class="my-2 space-y-4">
                <div class="flex justify-between flex-wrap gap-4">
                    <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search customer/order no " />
                    
                    <div class="flex gap-2 items-center">
                        <x-text-input type="date" name="from-date" wire:model.live.debounce.1000ms="from_date" />
                        <span>-</span>
                        <x-text-input type="date" name="to-date" wire:model.live.debounce.1000ms="to_date" />
                    </div>
                </div>
        
                <div class="grid grid-cols-1 lg:grid-cols-2 justify-between gap-4">
                    <div class="flex shrink-0 items-center gap-3 overflow-y-auto whitespace-nowrap">
                        @if ($from_date || $to_date)
                            <x-filter-tab variant="success"> 
                                @if ($from_date && !$to_date) 
                                    <div class="flex gap-1.5 items-center">
                                        <span>From: {{ date('d/m/Y',strtotime($from_date)) }}</span>
                                        <x-heroicon-m-x-mark class="size-4 cursor-pointer p-0.5 bg-transparent/50 hover:bg-transparent/70 rounded-xl" 
                                                             wire:click="clearFromDate"
                                        />
                                    </div>
                                @elseif ($to_date && !$from_date)
                                    <div class="flex gap-1.5 items-center">
                                        <span>To: {{ date('d/m/Y',strtotime($to_date)) }}</span> 
                                        <x-heroicon-m-x-mark class="size-4 cursor-pointer p-0.5 bg-transparent/50 hover:bg-transparent/70 rounded-xl"
                                                             wire:click="clearToDate"
                                         />
                                    </div>
                                @elseif ($from_date && $to_date) 
                                    <div class="flex gap-1.5 items-center">
                                        <span>Date: {{ date('d/m/Y',strtotime($from_date)) }} - {{ date('d/m/Y',strtotime($to_date))  }}</span>
                                        <x-heroicon-m-x-mark class="size-4 cursor-pointer p-0.5 bg-transparent/50 hover:bg-transparent/70 rounded-xl"
                                                             wire:click="clearAlldates" 
                                        />
                                    </div>
                                @endif
                            </x-filter-tab>
                        @else
                            <span>All orders ({{ $orders->total() }})</span>
                        @endif
                    </div>

                    <div class="flex items-center shrink-0 gap-4 lg:justify-end">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-icon-button class="p-0.5" title="{{ __('Import orders from another branch')}}">
                                    <x-heroicon-o-funnel class="size-6" />
                                </x-icon-button>
                            </x-slot>

                            <x-slot name="content" class="min-w-xs">
                                <div class="p-3 flex flex-col gap-4" wire:lazy>
                                    <div class="space-y-1.5 w-full">
                                        <x-input-label for="branch_id" value="{{ __('Branch') }}" />
                                        <select name="branch_id"
                                               wire:model.live="branch_id"
                                               class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm"
                                               >
                                           <option value="">{{ __('Filter by branch')}}</option>
                                           @foreach ($branches as $branch)
                                               <option wire:key="$branch->id" value="{{ $branch->id }}">{{ $branch->name }}</option>
                                           @endforeach
                                        </select>
                                    </div>

                                    <div class="space-y-1.5 w-full" wire:lazy>
                                        <x-input-label for="user_id" value="{{ __('User') }}" />
                                        <select name="user_id"
                                               wire:model.live="user_id"
                                               class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm"
                                               >
                                           <option value="">{{ __('Filter by user')}}</option>
                                           @foreach ($users as $user)
                                               <option wire:key="$user->id" value="{{ $user->id }}">{{ $user->name }}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                </div>
                            </x-slot>
                        </x-dropdown>
                        

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <x-icon-button class="p-0.5" title="{{ __('Import orders from another branch')}}">
                                    <x-heroicon-o-cloud-arrow-down class="size-6" />
                                </x-icon-button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link >
                                    <x-heroicon-m-printer class="size-4 mr-2 text-orange-400" />
                                    {{ __('Download PDF') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button class="w-full text-start">
                                    <x-dropdown-link>
                                        <x-heroicon-m-document-text class="size-4 text-teal-400 mr-2" />
                                        {{ __('Download EXCEL') }}
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
                        <tr class=" z-10">
                            <th class="md__th text-left md__th1">S/N</th>
                            <th class="md__th text-left">{{__('Date')}}</th>
                            <th class="md__th text-left">{{__('order')}}</th>
                            <th class="md__th text-right">{{__('Products')}}</th>
                            <th class="md__th text-right">{{__('Total')}}</th>
                            <th class="md__th text-left">{{__('Customer')}}</th>
                            <th class="md__th text-left">{{__('Seller')}}</th>
                            <th class="md__th text-left">{{__('Vendor')}}</th>
                            <!-- <th class="md__th text-left">{{__('Payment method')}}</th> -->
                            <th class="md__th text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="md__tbody">
                        @php
                        $rowId = 1;
                        @endphp
                        @foreach ($orders as $order)
                            <tr wire:key="{{ $order->id }}" class="md__tr">
                                <td class="md__td md__td1">{{ $rowId++ }}</td>
                                <td class="md__td">{{ date('d/m/Y H:m', strtotime($order->created_at)) }}</td>
                                <td class="md__td text-teal-600">{{ $order->id < 100 ? "#00$order->id": "#{$order->id}" }}</td>
                                <td class="md__td text-right">{{ number_format($order->order_items_count, 2) }}</td>
                                <td class="md__td text-right">{{ number_format($order->order_items_sum_v_total) }}</td>
                                <td class="md__td">{{ $order?->customer?->name ?? '-' }}</td>
                                <td class="md__td">{{ $order?->user?->name }}</td>
                                <td class="md__td">{{ $order?->vendor?->name ?? '--' }}</td>
                                <td class="md__td">
                                    <div class="flex items-center gap-3">
                                        <livewire:pendingorders.edit-stock :key="$order->id" :order_id="$order->id" />
                                        <button title="Approve all products" 
                                                wire:click="approve({{ $order->id }})"
                                                wire:confirm="Je unahakiki bidhaa zote za oda hii?"
                                        >
                                            <x-heroicon-o-check-circle class="size-8 text-green-500 hover:fill-current" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                @empty($orders->items())
                <x-empty>{{__('No pending orders found!')}}</x-empty>
                @endempty
            </div>
            <div class="my-2">
                {{ $orders->links()}}
            </div>
        </div>
    </section>
</div>

