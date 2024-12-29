<!DOCTYPE html>
<html>
<head>
    <title>Invoice-{{ $invoice->id }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">
    <div class="max-w-xl mx-auto bg-white">
        <div class="flex flex-col items-center justify-between mb-8 border-b-2 border-gray-300 pb-4">
             <div class="flex flex-col justify-center items-center text-center">
                <img src="{{ auth()->user()->company->logo ? asset(path: "storage/" . auth()->user()->company->logo): asset('logo2.png')}}" 
                     alt="{{ auth()->user()?->company?->name }}"
                     class="justify-center size-20 rounded-lg"
                >
                <p class="text-gray-700 font-semibold text-2xl leading-tight uppercase">{{ auth()->user()->company->name }}</p>
                <p class="text-gray-700 text-lg">{{ auth()->user()->company->address }}</p>
                <p class="text-gray-700 text-lg">MOB.{{ auth()->user()->company->phone }}</p>
                <p class="text-gray-700 text-lg">Email: {{ auth()->user()->company->email }}</p>
            </div>
        </div>
        <div class="flex justify-between border-b-2 border-gray-300 pb-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold mb-3">Bill To:</h2>
                <p class="text-gray-700 mb-2 uppercase">Name: {{ $invoice?->customer?->name ?? "____________________" }}</p>
                <p class="text-gray-700 mb-2">Contact: {{  $invoice?->customer?->contact ?? "____________________" }}</p>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2 uppercase">Invoice</div>
                <div class="text-sm">Date: {{ date('d/m/Y', strtotime($invoice->sale_date)) }}</div>
                <div class="text-sm">Invoice #: {{ $invoice->id }}</div>
            </div>
        </div>

        
        <div class="overflow-y-auto">
            <table class="w-full text-left mb-8 border-collapse">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="text-gray-700 font-bold uppercase p-2 text-sm">Description</th>
                        <th class="text-gray-700 font-bold uppercase p-2 text-sm">Qty</th>
                        <th class="text-gray-700 font-bold uppercase p-2 text-sm">Price</th>
                        <th class="text-gray-700 font-bold uppercase p-2 text-sm">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = 0;
                    @endphp
                    @foreach ($invoice->orderItems as $item)
                        @php $total += $item->total @endphp
                        <tr wire:key="$item->id" class="border-b border-gray-300">
                            <td class="p-2 text-gray-700">{{ $item?->product?->name }}</td>
                            <td class="p-2 text-gray-700">{{ number_format($item->qty) }}</td>
                            <td class="p-2 text-gray-700">{{ number_format($item->price, 2) }}</td>
                            <td class="p-2 text-gray-700">{{ number_format($item->total, 2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col justify-between items-start gap-2">
            <div class="w-full">
                <div class="flex justify-end mb-2">
                    <div class="text-gray-700 mr-2">Status:</div>
                    <div class="text-green-700">{{ $invoice->status }}</div>
                </div>
                <div class="flex justify-end mb-8">
                    <div class="text-gray-700 mr-2">Total: </div>
                    <div class="text-gray-700 font-bold border text-xl">TSH {{ number_format($total) }}</div>
                </div>
            </div>
            <div class="text-center w-full">
                <p class="text-gray-700">Issued by <b class="uppercase">{{ auth()->user()?->name }}</b></p>
                <i class="">Thank you for choosing us.</i>
            </div>
        </div>
    </div>
</body>
</html>

