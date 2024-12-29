<div class="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-none">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex gap-2 items-center mt-2 justify-end sm:px-4 lg:px-6">
        <a href="{{ route('dashboard') }}" class="mr-auto">
            <x-secondary-button>Reload</x-secondary-button>
        </a>
        <!-- <button class="bg-cyan-600 text-white leading-tight px-4 py-2 rounded">text slah</button> -->
        <x-text-input type="date" name="from-date" wire:model.live.debounce.1000ms="from_date" />
        <span>-</span>
        <x-text-input type="date" name="to-date" wire:model.live.debounce.1000ms="to_date" />
    </div>

    <div class="py-6">
        <div class="sm:px-4 lg:px-6 grid grid-cols-3 gap-4 overflow-x-auto">
            <div class="p-4 rounded-lg space-y-4 border border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-700">
                <p class="font-medium leading-none">Capital</p>
                <p class="text-xl font-medium">{{ number_format($capital)}}</p>
            </div>

            <div class="p-4 rounded-lg space-y-4 border border-gray-200 bg-red-300/20 dark:border-gray-700">
                <p class="t font-medium leading-none">Expenses</p>
                <p class="text-xl font-medium">{{ number_format($expenses)}}</p>
            </div>

            <div class="p-4 rounded-lg space-y-4 bg-teal-700/30 dark:border-gray-700">
                <p class="t font-medium leading-none">Sales</p>
                <p class="text-xl font-medium">{{ number_format($sales)}}</p>
            </div>

            <div class="p-4 rounded-lg space-y-4 bg-green-500/50 dark:border-gray-700">
                <p class="t font-medium leading-none">Profit</p>
                <p class="text-xl font-medium">{{ number_format($profit)}}</p>
            </div>

            <div class="p-4 rounded-lg space-y-4 bg-teal-800/30">
                <p class="t font-medium leading-none">Net sales</p>
                <p class="text-xl font-medium">{{ number_format($sales - $expenses)}}</p>
            </div>

            <div class="p-4 rounded-lg space-y-4 bg-green-800/40">
                <p class="t font-medium leading-none">Net Profit</p>
                <p class="text-xl font-medium">{{ number_format($profit - $expenses)}}</p>
            </div>
        </div>

        <div class="md__table_wrapper w-7xl mx-auto sm:px-4 lg:px-6 gap-4">
            <table class="md__table">
                <thead class="md__thead">
                    <tr>
                        <th class="md__th md__th1">S/N</th>
                        <th class="md__th">USER</th>
                        <th class="md__th text-right">Expenses</th>
                        <th class="md__th text-right">SALES</th>
                        <th class="md__th text-right">Profit</th>
                        <th class="md__th text-right">Net sales</th>
                        <th class="md__th text-right">Net Profit</th>
                    </tr>
                </thead>
                <tbody class="md__tbody">
                    @php
                    $id = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr class="md__tr" wire:key="$user->id">
                            <td class="md__td md__td1">{{ $id++ }}</td>
                            <td class="md__td">{{ $user->name }}</td>
                            <td class="md__td text-right">{{ number_format( $user->expense_items_sum_cost, 2)}}</td>
                            <td class="md__td text-right">{{ number_format($user->order_items_sum_total, 2)}}</td>
                            <td class="md__td text-right">{{ number_format($user->order_items_sum_profit, 2)}}</td>
                            <td class="md__td text-right">{{ number_format($user->order_items_sum_total - $user->expense_items_sum_cost, 2)}}</td>
                            <td class="md__td text-right">{{ number_format($user->order_items_sum_profit - $user->expense_items_sum_cost, 2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
