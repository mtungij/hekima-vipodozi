<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Damages')}} (<span class="text-cyan-500">{{ auth()->user()->branch->name}}</span>)
        </h2>
    </x-slot>

    <section>
    <div class="sm:px-6 lg:px-4 space-y-6">
        <div class="my-2 space-y-4">
            <div class="flex justify-between gap-4">
                <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search product ..." />
                
                <livewire:damages.create-damage />
            </div>
    
            <div class="grid grid-cols-1 lg:grid-cols-2 justify-between gap-4">
                <div class="flex shrink-0 items-center gap-3 overflow-y-auto whitespace-nowrap">
                    <button class="rounded-2xl cursor-pointer select-none dark:text-gray-950 bg-green-400 px-4 py-1 text-sm">
                       All damages. {{ number_format($total) }}
                    </button>
                </div>

                <div class="flex items-center shrink-0 gap-4 lg:justify-end">
                    {{-- <livewire:products.filters.filter-product-by-branch /> --}}

                    <x-text-input type="date" name="date" wire:model.live.debounce.2000ms="date" />

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <x-icon-button class="p-0.5" title="{{ __('filters')}}">
                                <x-heroicon-o-funnel class="size-6" />
                            </x-icon-button>
                        </x-slot>

                        <x-slot name="content" class="p-3">
                            <div class="p-3 space-y-1.5">
                                <x-input-label for="user_id" value="{{ __('By user') }}" />
                
                                <select name="user_id" 
                                        wire:model.live.debounce.2000ms="user_id"
                                        class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                                        >
                                    <option value="">{{ __('filter by user')}}</option>
                                    @foreach ($users as $user)
                                        <option wire:key="$user->id" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                        <th class="md__th text-left">{{__('Product')}}</th>
                        <th class="md__th text-left">{{__('Amount')}}</th>
                        <th class="md__th text-left">{{__('Description')}}</th>
                        <th class="md__th text-left">{{__('Date')}}</th>
                        <th class="md__th"></th>
                    </tr>
                </thead>
                <tbody class="md__tbody">
                    @php
                    $rowId = 1;
                    @endphp
                    @foreach ($this->damages as $damage)
                        <tr wire:key="{{ $damage->id }}" class="md__tr">
                            <td class="md__td md__td1"">{{ $rowId++ }}</td>
                            <td class="md__td">
                                    {{ $damage->product?->name }}
                            </td>
                            <td class="md__td">{{ $damage->amount }}</td>
                            <td class="md__td">{{ $damage->desc }}</td>
                            <td class="md__td">{{ date('d/m/Y H:m', strtotime($damage->created_at)) }}</td>
                            <td class="md__td">
                                <div class="flex items-center gap-3">
                                    
                                    <button wire:click="delete({{$damage->id}})" 
                                            wire:confirm.prompt="Are you sure that you want to delete - {{ $damage->name }}?\n\nType DELETE to confirm|DELETE"
                                    >
                                        <x-heroicon-o-trash class="size-5 text-red-500" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @empty($this->damages->items())
            <x-empty>{{__('No damages found!')}}</x-empty>
            @endempty
        </div>
        <div class="my-2">
            {{ $this->damages->links()}}
        </div>
    </div>
</section>
</div>
