<?php

use function Livewire\Volt\{state};

//

?>

<div class="h-dvh overflow-y-auto pb-5 pl-4">
    <div class="pb-3 flex justify-center items-center">
        <div class="size-16 rounded-lg bg-gray-700/10">
            <img src="{{ asset('logo2.png')}}" loading="lazy" alt="logo">
        </div>
    </div>
    <div class="grid gap-1">
        @if (auth()->user()->role == 'admin')
        <x-sidebar-item :url="route('dashboard')" :active="request()->routeIs('dashboard')">
            <x-slot:icon>
                <x-heroicon-o-home />
            </x-slot:icon>
    
            Dashboard
        </x-sidebar-item>
        @endif

        <x-sidebar-item :url="route('my-sales')" :active="request()->routeIs('my-sales')">
            <x-slot:icon>
                <x-heroicon-o-chart-bar />
            </x-slot:icon>
    
            My Sales
        </x-sidebar-item>
    
         @if (auth()->user()->role == 'admin')
        <x-sidebar-item :url="route('setup')" :active="request()->routeIs('setup')">
            <x-slot:icon>
                <x-heroicon-o-cog-6-tooth />
            </x-slot:icon>
    
            System Setup
        </x-sidebar-item>
        @endif
    
         @if (auth()->user()->role == 'admin')
        <x-sidebar-item :url="route('products')" :active="request()->routeIs('products')">
            <x-slot:icon>
                <x-heroicon-o-book-open />
            </x-slot:icon>
    
            Products
        </x-sidebar-item>
        
        <x-sidebar-item :url="route('users')" :active="request()->routeIs('users')">
            <x-slot:icon>
                <x-heroicon-o-users />
            </x-slot:icon>
            
            Users (Employees)
        </x-sidebar-item>
        @endif
    
        {{-- <x-sidebar-item :url="route('customers')" :active="request()->routeIs('customers')">
            <x-slot:icon>
                <x-heroicon-o-user />
            </x-slot:icon>
    
            Customers
        </x-sidebar-item> --}}
    
        <x-sidebar-item :url="route('pos')" :active="request()->routeIs('pos')">
            <x-slot:icon>
                <x-heroicon-o-shopping-cart />
            </x-slot:icon>
    
            {{__('Point of Sale')}}(POS)
        </x-sidebar-item>
    
        <x-sidebar-item :url="route('expenses')" :active="request()->routeIs('expenses')">
            <x-slot:icon>
                <x-heroicon-o-wallet />
            </x-slot:icon>
            
            {{__('Expenses')}}
        </x-sidebar-item>
        
         @if (auth()->user()->role == 'admin')
        <x-sidebar-item :url="route('invoices')" :active="request()->routeIs('invoices')">
            <x-slot:icon>
                <x-heroicon-o-document-arrow-down />
            </x-slot:icon>
    
            {{__('Invoices')}}
        </x-sidebar-item>
        
        {{-- <x-sidebar-item :url="route('pending-orders')" :active="request()->routeIs('pending-orders')">
            <x-slot:icon>
                <x-heroicon-o-shopping-bag />
            </x-slot:icon>
            
            {{__('Pending orders')}}
        </x-sidebar-item>
    
        <x-sidebar-item :url="route('credit-sales')" :active="request()->routeIs('credit-sales')">
            <x-slot:icon>
                <x-heroicon-o-rectangle-stack />
            </x-slot:icon>
            
            {{__('Credit sales')}}
        </x-sidebar-item> 
        <x-sidebar-item :url="route('stock-transfer')" :active="request()->routeIs('stock-transfer')">
            <x-slot:icon>
                <x-heroicon-o-receipt-refund />
            </x-slot:icon>
            
            {{__('Stock transfer')}}
        </x-sidebar-item>
         --}}
        
         
         
         <x-sidebar-item :url="route('new-stock')" :active="request()->routeIs('new-stock')">
             <x-slot:icon>
                 <x-heroicon-o-squares-plus />
                </x-slot:icon>
                
                {{__('New stocks')}}
            </x-sidebar-item>
            
            <x-sidebar-item :url="route('inventory')" :active="request()->routeIs('inventory')">
                <x-slot:icon>
                    <x-heroicon-o-scale />
                </x-slot:icon>
                
                {{__('Stocks Inventory')}}
            </x-sidebar-item>
            
            <x-sidebar-item :url="route('damages')" :active="request()->routeIs('damages')">
                <x-slot:icon>
                    <x-heroicon-o-trash />
                </x-slot:icon>
                
                {{__('Damaged products')}}
            </x-sidebar-item>
            
            <x-sidebar-item :url="route('reports')" :active="request()->routeIs('reports')">
                <x-slot:icon>
                    <x-heroicon-m-document-chart-bar />
                </x-slot:icon>
            
            {{__('Reports')}}
        </x-sidebar-item>
        @endif
    </div>
</div>
