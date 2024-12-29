<div class="bg-gray-300 print:bg-white py-4">
    <x-slot name="header">
        <div class="flex justify-end gap-4">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight mr-auto">
                Invoice No. <span class="text-orange-500">{{ $invoice->id }}</span>
            </h2>

            <button class="hover:text-cyan-600" id="print">
                <span class="sr-only">Print this invoice</span>
                <x-heroicon-o-printer class="size-6" />
            </button>
        </div>
    </x-slot>

    <div class="px-4 mt-4 py-8 max-w-2xl mx-auto bg-white">
        @if (auth()->user()->role == 'admin')
        <button wire:click="deleteInvoice({{$invoice->id}})"
                wire:confirm="When you delete this Invoice the stock of the associated products will be restored and it's sales will be deleted.
                                         \nAre you sure you want to delete it?"
                class="flex items-center gap-1.5 text-red-500 hover:text-red-300 print:hidden"
            >
            <x-heroicon-o-trash class="size-6 stroke-2" />
            <span class="">{{__('Delete')}}</span>
        </button>
        @endif
        <div class="flex flex-col items-center justify-between mb-8 border-b-2 border-gray-300 pb-4">
             <livewire:utils.docs-header />
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
                        @if (auth()->user()->role == 'admin')
                        <th class="text-gray-700 font-bold uppercase p-2 text-sm print:hidden"></th>
                        @endif
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
                            @if (auth()->user()->role == 'admin')
                            <td class="p-2 print:hidden">
                                <button wire:click="deleteInvoiceItem({{ $item->id }})" 
                                        wire:confirm="When you delete this item the stock of the associated product will be restored and it's sales will be deleted.
                                         \nAre you sure you want to delete it?">
                                    <x-heroicon-m-trash class="size-4 text-red-600 hover:text-red-400" />
                                </button>
                            </td>
                            @endif
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

    @script
    <script>
        const printBtn = document.getElementById('print')

        printBtn.addEventListener('click', () => {
            print()
        })
    </script>
    @endscript
</div>
