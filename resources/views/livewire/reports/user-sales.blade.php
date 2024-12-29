<?php

use App\Models\OrderItem;
use App\Models\user;
use Illuminate\Database\Eloquent\Builder;

use function Livewire\Volt\{state, layout, title, computed, usesPagination, with};

usesPagination();

state([
    'from_date' => null,
    'to_date' => null,
    'user_id' => null,
]);

$products = computed(function () {
    return OrderItem::with(['order.user', 'product'])
                        ->when($this->user_id, function (Builder $query) {
                            $query->whereRelation('order', 'user_id', $this->user_id);
                        })
                        ->when($this->from_date && !$this->to_date, function (Builder $query) {
                            $query->whereDate('created_at', '>=', $this->from_date);
                        })
                        ->when(!$this->from_date && $this->to_date, function (Builder $query) {
                            $query->whereDate('created_at', '<=', $this->to_date);
                        })
                        ->when($this->from_date && $this->to_date, function (Builder $query) {
                            $query->whereDate('created_at', '<=', $this->to_date)
                                  ->whereDate('created_at', '>=', $this->from_date);
                        })
                        ->latest()->paginate(100);
});

title('User sales');

with([
    'users' => user::get(),
]);

layout('layouts.app');

?>

<div>
     <x-slot name="header">
        <div class="flex justify-end gap-4">
            <a href="{{ url()->previous() }}" wire:navigate>
                <x-heroicon-o-arrow-left-circle class="size-6 hover:fill-current" />
            </a>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight mr-auto">
                {{__('Sellers report')}}
            </h2>

            <button class="hover:text-cyan-600" id="print">
                <span class="sr-only">Print items</span>
                <x-heroicon-o-printer class="size-6" />
            </button>
        </div>
    </x-slot>

    <div class="sm:px-4 lg:px-6 gap-4">
            <div class="flex justify-between flex-wrap gap-4 py-6">
                <div>
                    <x-input-label for="product_id" value="{{ __('') }}" />
    
                    <select name="user_id" 
                            wire:model.live.debounce.1000ms="user_id"
                            class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-teal-500 dark:focus:border-teal-600 focus:ring-teal-500 dark:focus:ring-teal-600 rounded-md shadow-sm"
                            >
                        <option value="">{{ __('Filter by seller')}}</option>
                        @foreach ($users as $user)
                            <option wire:key="$user->id" value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>
                
                <div class="flex gap-2 items-center">
                    <x-text-input type="date" name="from-date" wire:model.live.debounce.1000ms="from_date" />
                    <span>-</span>
                    <x-text-input type="date" name="to-date" wire:model.live.debounce.1000ms="to_date" />
                </div>
            </div>
            <div class="md__table_wrapper">
                <table class="md__table">
                    <thead class="md__thead">
                        <tr>
                            <th class="md__th md__th1">S/N</th>
                            <th class="md__th md__th1">INVO NO</th>
                            <th class="md__th text-left">DATE</th>
                            <th class="md__th text-left">SELLER</th>
                            <th class="md__th text-left">PRODUCT</th>
                            <th class="md__th text-left">UNIT</th>
                            <th class="md__th text-right">QTY</th>
                            <th class="md__th text-right">PRICE</th>
                            <th class="md__th text-right">PROFIT</th>
                        </tr>
                    </thead>
                    <tbody class="md__tbody">
                        @php
                        $id = 1; $total = 0; $qty = 0; $profit = 0;
                        @endphp
                        @foreach ($this->products as $product)
                         @php
                         $qty += $product->qty;
                         $total += $product->total;
                         $profit += $product->profit;
                         @endphp
                            <tr class="md__tr" wire:key="$product->id">
                                <td class="md__td md__td1">{{ $id++ }}</td>
                                <td class="md__td md__td1">{{ $product->order?->id }}</td>
                                <td class="md__td">{{ date('d/m/Y H:m:i', strtotime($product->created_at)) }}</td>
                                <td class="md__td">{{ $product->order?->user?->name }}</td>
                                <td class="md__td">{{ $product->product?->name }}</td>
                                <td class="md__td">{{ $product->product?->unit }}</td>
                                <td class="md__td text-right">{{ number_format( $product->qty, 2)}}</td>
                                <td class="md__td text-right">{{ number_format($product->total, 2)}}</td>
                                <td class="md__td text-right">{{ number_format($product->profit, 2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="md__tfoot">
                        <tr>
                            <td class="md__td"></td>
                            <th class="md__th">TOTAL</th>
                            <td class="md__td"></td>
                            <td class="md__td"></td>
                            <td class="md__td"></td>
                            <td class="md__td"></td>
                            <td class="md__td">{{ number_format($qty, 2)}}</td>
                            <td class="md__td">{{ number_format($total, 2)}}</td>
                            <th class="md__th">{{ number_format($profit, 2)}}</th>
                        </tr>
                    </tfoot>
                </table>
                @empty($this->products->items())
                    <x-empty>{{__('No products sold')}}</x-empty>
                @endempty
            </div>
    </div>

    @script
    <script>
        const printBtn = document.getElementById('print')

        printBtn.addEventListener('click', () => {
            print()
        })
    </script>
    @endscript
</div>
