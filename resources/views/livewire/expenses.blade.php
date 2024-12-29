<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Expenses')}}
        </h2>
    </x-slot>

    <section class="py-4 space-y-6">
        <p class="bg-gray-600 text-white p-2">Add Expenses</p>
        <livewire:expenses.create-expense />

        <div class="md__table_wrapper">
            <p class="bg-gray-600 text-white p-2">Your expenses today</p>

            <table class="md__table">
                <thead class="md__thead">
                    <tr>
                        <th class="md__th md__th1">S/N</th>
                        <th class="md__th text-left">{{__('Payment method')}}</th>
                        <th class="md__th text-left">{{__('Total')}}</th>
                        <th class="md__th text-left">{{__('Items')}}</th>
                        <th class="md__th text-left">{{__('')}}</th>
                    </tr>
                </thead>
                <tbody class="md__tbody">
                    @php $id = 1; @endphp
                    @foreach ($expenses as $expense)
                    <tr class="md__tr" wire:key="$expense->id">
                        <td class="md__td md__td1">{{ $id++ }}</td>
                        <td class="md__td">{{ $expense?->paymentMethod?->name}}</td>
                        <td class="md__td">{{ number_format($expense->expense_items_sum_cost, 2)}}</td>
                        <td class="md__td w-full" colspan="2">
                            <table class="w-full table">
                                @foreach ($expense->expenseItems as $item)
                                   <tr class="md__tr" wire:key="$item->id">
                                       <td class="md__td">{{ $item->item }}</td>
                                       <td class="md__td">{{ number_format($item->cost, 2) }}</td>
                                   </tr>
                                @endforeach
                            </table>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
