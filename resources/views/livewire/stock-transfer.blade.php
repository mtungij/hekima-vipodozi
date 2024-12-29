<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Stock transfer')}}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 divide-x-2 text-white -mx-4">
        <a class="bg-gray-500 py-2 pl-2 lg:pl-6 " href="{{ route('stock-transfer')}}" 
           wire:navigate
        >{{ __('Transfer')}}</a>
        <a class="bg-gray-600 p-2" href="{{ route('stock-transfer.transfered')}}"
           wire:navigate
        >{{ __('Transfered')}}</a>
    </div>

    <section class="py-4 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <livewire:stock-transfers.transfer-cart />
        </div>
        
        <div class="space-y-4">
            <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search product" />

            <div class="md__table_wrapper">
                <table class="md__table">
                    <thead class="md__thead">
                        <tr>
                            <th class="md__th text-left">{{ __('Product') }}</th>
                            <th class="md__th text-left">{{ __('Stock')}}</th>
                        </tr>
                    </thead>
                    <tbody class="md__tbody">
                        @foreach ($products as $product)
                            <tr class="md__tr cursor-pointer" wire:key="$product->id" wire:click="addToCart({{$product->id}})">
                                <td class="md__td">{{ $product->name }}</td>
                                <td class="md__td">{{ number_format($product->stock)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @empty($products->items())
                  <x-empty>{{__('No products found!')}}</x-empty>
                @endempty
            </div>
        </div>
    </section>
</div>
