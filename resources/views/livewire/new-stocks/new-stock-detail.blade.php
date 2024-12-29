<div>
    <x-slot name="header">
        <div class="flex justify-end gap-4">
            <a href="{{ route('new-stock.all')}}">
                <x-heroicon-o-arrow-left-circle class="size-6 hover:fill-current" />
            </a>
            <h2 class="font-semibold text-xl text-gray-200 leading-tight mr-auto">
                {{__('New stocks')}}
            </h2>

            <button class="hover:text-cyan-600" id="print">
                <span class="sr-only">Print items</span>
                <x-heroicon-o-printer class="size-6" />
            </button>
        </div>
    </x-slot>

    <div class="max-w-2xl p-4 mx-auto bg-gray-200 print:bg-gray-100 my-8">
        <div class="py-4">
            <livewire:utils.docs-header />
        </div>
        <p class="text-lg uppercase text-center text-gray-900 bg-blue-400">
             {{ $newStock?->branch?->name }} New Stocks
        </p>
        <div class="md__table_wrapper">
            <table class="md__table">
                <thead class="md__thead">
                    <tr>
                        <th class="md__th text-left">{{ __('Product') }}</th>
                        <th class="md__th text-left">{{ __('Stock')}}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    @foreach ($items as $item)
                        <tr class="md__tr" wire:key="$item->id">
                            <td class="md__td">{{ $item?->product?->name }}</td>
                            <td class="md__td">
                                {{ number_format($item->stock, 2)}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @empty($items)
                <x-empty>{{__('No products!')}}</x-empty>
            @endempty
        </div>

        <div class="py-4 italic text-center text-gray-600">
            <p>{{ date('d/m/Y H:m', strtotime($newStock->created_at))}}</p>
            <p class="">Issued by <b>{{ $newStock?->user?->name }}</b></p>
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
