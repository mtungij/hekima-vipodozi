<!DOCTYPE html>
<html>
<head>
    <title>Invoices</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-dvh p-6">
    <div class="w-full">
        <div class="text-gray-700 text-center mb-4">
            <p class="uppercase font-semibold text-lg">{{ auth()->user()?->company->name }} INVOICES</p>
        </div>
    
        <table class="w-full">
            <thead>
                <tr class="text-white">
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">S/N</th>
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">{{__('Invoice')}}</th>
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">{{__('Total')}}</th>
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">{{__('Status')}}</th>
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">{{__('Customer')}}</th>
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">{{__('Issued on')}}</th>
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">{{__('Seller')}}</th>
                    <th class="p-2 text-xs text-left uppercase bg-teal-700">{{__('Payment method')}}</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @php
                $rowId = 1;
                @endphp
                @foreach ($invoices as $invoice)
                <tr class="border-b border-gray-300">
                    <td class="p-2 text-sm  bg-white">{{ $rowId++ }}</td>
                    <td class="p-2 text-sm text-teal-600 ">{{ $invoice->id < 100 ? "#00$invoice->id": "#{$invoice->id}" }}</td>
                    <td class="p-2 text-sm ">{{ number_format($invoice->order_items_sum_total, 2) }}</td>
                    @if ($invoice->status == 'paid')
                        <td class="p-2 text-sm text-left text-green-500">
                            {{ $invoice->status }}
                        </td>
                    @elseif($invoice->status == 'pending')
                        <td class="p-2 text-sm text-left text-yellow-500">
                            {{ $invoice->status }}
                        </td>
                    @else
                        <td class="p-2 text-sm text-left text-red-500">
                            {{ $invoice->status }}
                        </td>
                    @endif
                    <td class="p-2 text-sm text-left ">{{ $invoice?->customer?->name ?? '-' }}</td>
                    <td class="p-2 text-sm text-left ">{{ date('d/m/Y H:m', strtotime($invoice->created_at)) }}</td>
                    <td class="p-2 text-sm text-left ">{{ $invoice?->user?->name }}</td>
                    <td class="p-2 text-sm text-left  uppercase">{{ $invoice?->paymentMethod?->name ?? "-" }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Subtotal:</div>
            <div class="text-gray-700">$425.00</div>
        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Tax:</div>
            <div class="text-gray-700">$25.50</div>
        </div>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">$450.50</div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-8">
            <div class="text-gray-700 mb-2">Payment is due within 30 days. Late payments are subject to fees.</div>
            <div class="text-gray-700 mb-2">Please make checks payable to Your Company Name and mail to:</div>
            <div class="text-gray-700">123 Main St., Anytown, USA 12345</div>
       </div> -->
    </div>
</body>
</html>
