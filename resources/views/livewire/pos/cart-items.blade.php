<div>
    <div class="relative space-y-4 bg-white dark:bg-gray-500/20 overflow-auto whitespace-nowrap" wire:lazy>
        <table class="w-full border-collapse border dark:border-gray-700">
            <thead class="dark:text-gray-300">
                <tr class=" z-10">
                    <th class="p-2 text-xs text-left uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('Product')}}</th>
                    <th class="p-2 text-xs text-right uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('Qty')}}</th>
                    <th class="p-2 text-xs text-right uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('Price')}}</th>
                    <th class="p-2 text-xs text-right uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('Total')}}</th>
                    <th class="p-2 text-xs  border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0"></th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-400">
                @php
                $totalPrice = 0;
                $totalTransport = 0;
                @endphp
                @foreach ($this->cartItems as $item)
                    <tr wire:key="{{ $item->id }}" class="transition-colors hover:bg-gray-200/90 dark:hover:bg-gray-700/50 data-[state=selected]:bg-gray-100/50">
                        <td class="p-1.5 text-sm border dark:border-gray-700">
                                {{ $item?->product?->name }}~ <span class="text-green-500">{{ number_format($item->product->stock)}}</span>
                        </td>
                        @php 
                        $totalPrice += $item->qty * $item->price; 
                        $totalTransport += $item->qty * $item->transport;
                        @endphp
                        <td class="p-1.5 text-sm border flex justify-end dark:border-gray-700">
                            <livewire:pos.update-cart-item :item="$item" :key="$item->id" />
                        </td>
                        <td class="p-1.5 text-sm text-right border dark:border-gray-700">{{ number_format($item->price) }}</td>
                        <td class="p-1.5 text-sm text-right border dark:border-gray-700">{{ number_format($item->price * $item->qty) }}</td>
                        <td class="p-1.5 text-sm text-right border dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                {{--<livewire:item.edit-item :item="$item" :key="$item->id"  />--}}
    
                                <button wire:click="deleteItem({{$item->id}})"
                                        wire:confirm="Are you sure that you want to delete - {{ $item->product->name }}?"
                                >
                                    <x-heroicon-o-trash class="size-5 text-red-500" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        @empty($this->cartItems())
          <x-empty>{{__('No cart items found!')}}</x-empty>
        @endempty
    </div>

    <div class="md:relative md:bottom-0 w-full max-h-dvh mt-4 space-y-4 bg-white dark:bg-transparent overflow-auto whitespace-nowrap">
        <table class="w-full border-collapse border dark:border-gray-700">
            <tbody class="text-gray-600 dark:text-gray-400">
                <tr class="transition-colors border-b dark:border-gray-700 hover:bg-gray-200/90 dark:hover:bg-gray-700/50 data-[state=selected]:bg-gray-100/50">
                    <td class="p-2 text-sm font-semibold">Total Price</td>
                    <td class="p-2 text-sm text-right text-bold dark:text-white">{{ number_format($totalPrice, 2) }}</td>
                </tr>
                {{-- <tr class="transition-colors border-b dark:border-gray-700 hover:bg-gray-200/90 dark:hover:bg-gray-700/50 data-[state=selected]:bg-gray-100/50">
                    <td class="p-2 text-sm font-semibold">Total Transport Fee</td>
                    <td class="p-2 text-sm text-right text-bold dark:text-white">{{ number_format($totalTransport, 2) }}</td>
                </tr> 
                <tr class="transition-colors border-b dark:border-gray-700 hover:bg-gray-200/90 dark:hover:bg-gray-700/50 data-[state=selected]:bg-gray-100/50">
                    <td class="p-2 text-sm font-semibold">Price + transport </td>
                    <td class="p-2 text-sm text-right text-bold dark:text-white">{{ number_format($totalPrice + $totalTransport, 2) }}</td>
                </tr>
                --}}
            </tbody>
        </table>
    </div>

</div>
