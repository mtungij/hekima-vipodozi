<?php

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

use function Livewire\Volt\{state, usesPagination, computed};

usesPagination();

state(['search' => '']);

state([
    'transportFee' => auth()->user()?->cart?->transportFee,
]);

$products = computed(function () {
    $productsExistsToCart = auth()->user()->cartItems()->pluck('product_id')->toArray();

    return Product::where('name', 'LIKE', "%{$this->search}%")
                     ->whereNotIn('id', $productsExistsToCart)
                     ->paginate(5);
});


$addToCart = function (Product $product) {
    $cartExists = auth()->user()->cart;

    if ($product->stock <= 0) {
        session()->flash('error', 'Stock is not enough.');
        return $this->redirect(route('pos'), navigate:true);
    }

    if ($cartExists) {
        $cartExists->cartItems()->create([
            'product_id' => $product->id,
            'buy_price' => $product->buy_price,
            'price' => $product->sale_price,
            'qty' => 1,
            'transport' => $product->transport,
        ]);

    } else {
        $newCart = Cart::create(['user_id' => auth()->id()]);

        $newCart->cartItems()->create([
            'product_id' => $product->id,
            'buy_price' => $product->buy_price,
            'price' => $product->sale_price,
            'qty' => 1,
            'transport' => $product->transport,
        ]);

        session('success', 'New cart created. Product added to the cart.');
    }

    $this->redirect(route('pos'), navigate:true);
};

$save = function () {
    auth()->user()->cart->update([
        'customer_id' => $this->customer_id,
        'payment_method_id' => $this->payment_method_id,
        'vendor_id' => $this->vendor_id,
        'transportFee' => $this->transportFee,
    ]);
};

$chargeTransport = function () {
    auth()->user()->cart->update([
        'transportFee' => $this->transportFee,
    ]);

    $this->redirect(route('pos'), navigate:true);
};

$deleteCustomer = function () {
    auth()->user()->cart->customer->delete();

    $this->redirect(route('pos'), navigate:true);
};

$completeOrder = function (): void {
    $cart = auth()->user()->cart;
    $cartItems = auth()->user()->cartItems()->get();
    
    DB::transaction(callback: function () use($cartItems, $cart): void {
    //create order from cart
    $order = Order::create($cart->toArray());
    
        //create orderiems from cartItems
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
    
            // when order status is pending add cartitem qty to v_qty
            switch ($order->status) {
                case 'pending':
                    $order->orderItems()->create([
                        'product_id' => $item->product_id,
                        'buy_price' => $item->buy_price,
                        'price' => $item->price,
                        'qty' => 0.00,
                        'v_qty' => $item->qty,
                    ]);
                    break;
                
                default:
                    $order->orderItems()->create($item->toArray());
                    break;
            }
    
            //decrement the product's stock
            $product->decrement('stock', $item->qty);
        }
    
        //delete the cart
        $cart->delete();

        session()->flash('success', 'Sales made successfully.');

        //redirect user to invoice created
        $this->redirect(route('pos'), navigate:true);
    }, attempts: 3);

};
?>

<div class="pb-4">
    <div class="my-2 w-full">
        <x-text-input type="search" class="w-full" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search product" />
    </div>
    <div class="relative max-h-dvh space-y-4 bg-white dark:bg-gray-500/20 overflow-auto whitespace-nowrap" wire:lazy>
        <table class="w-full border-collapse border dark:border-gray-700">
            <thead class="dark:text-gray-300">
                <tr class=" z-10">
                    <th class="1 text-xs text-left uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('Product')}}</th>
                    <th class="1 text-xs text-right uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('Stock')}}</th>
                    <th class="1 text-xs text-right uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('Selling price')}}</th>
                    {{-- <th class="1 text-xs text-right uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('W.Price')}}</th>
                            <th class="1 text-xs text-right uppercase border dark:border-gray-700 bg-white dark:bg-gray-800 sticky top-0">{{__('W.Stock')}}</th> --}}
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-400">
                @foreach ($this->products as $product)
                    <tr wire:key="{{ $product->id }}" 
                        wire:click="addToCart({{$product->id}})"
                        class="transition-all duration-150 cursor-pointer hover:bg-gray-200/90 dark:hover:bg-gray-700/50 data-[state=selected]:bg-gray-100/50">
                        <td class="p-1 text-sm border dark:border-gray-700">
                                {{ $product?->name }}~<span class="text-orange-500">{{ $product->unit }}</span>
                        </td>
                        <td class="p-1 text-right border dark:border-gray-700">
                            {{ number_format($product->stock,2)}}
                        </td>
                        <td class="p-1 text-sm text-right border dark:border-gray-700">{{ number_format($product->sale_price ) }}</td>
                        {{-- <td class="p-1 text-sm text-right border dark:border-gray-700">{{ number_format($product->whole_price) }}</td>
                        <td class="p-1 text-sm text-right border dark:border-gray-700 uppercase">{{ number_format($product->whole_stock, 2) }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        @empty($this->products->items())
            <x-empty>{{__('No products found!')}}</x-empty>
        @endempty
    </div>

     {{-- show cart actions only if a user has created a cart --}}
    @if (auth()->user()->cart)
        <div class="mt-6 space-y-4">
            @if (auth()->user()?->cart?->customer_id)
            <p class="flex gap-4">
                <span>Customer: </span>
                <span class="text-green-500 font-semibold">{{ auth()->user()?->cart?->customer?->name}}</span>

                <button wire:click="deleteCustomer"
                        class="text-xs font-semibold text-red-500 hover:text-red-400 underline underline-offset-4"
                        wire:confirm="{{__('Are you sure that you want to delete this customer?')}}"
                >Delete</button>
                </p>
            @else
                <livewire:pos.cart-create-customer />
            @endif

            <livewire:pos.cart-update-payment-method />

             {{-- <livewire:pos.cart-update-status /> 

            <div>
                <label for="transportFee" class="inline-flex items-center">
                    <input id="transportFee" wire:model="transportFee" wire:change="chargeTransport" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-teal-600 shadow-sm focus:ring-teal-500 dark:focus:ring-teal-600 dark:focus:ring-offset-gray-800" name="transportFee">
                    <span class="ms-2  text-gray-600 dark:text-gray-400">{{ __('Charge transport fee?') }}</span>
                </label>
            </div> --}}

            <div class="flex justify-center">
                <button class="flex gap-2 items-center bg-cyan-600 text-white px-6 py-3 rounded-3xl hover:bg-cyan-500 hover:scale-x-105 transition-all duration-150 disabled:bg-cyan-600/20 disabled:text-white/50"
                        wire:loading.attr="disabled"
                        wire:click="completeOrder"
                        @disabled(!auth()->user()?->cart?->exists())
                >
                    <span>{{__('Complete order')}}</span>
                    <x-heroicon-m-arrow-path wire:loading class="size-4 animate-spin text-teal-500" />
                </button>
            </div>
        </div>
    @endif

</div>

