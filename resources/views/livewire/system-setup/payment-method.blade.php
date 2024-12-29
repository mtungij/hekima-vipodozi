<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Payment methods') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('List of accounts used to receive payments.') }}
        </p>
    </header>

    <div class="my-2">
        <livewire:system-setup.create-payment-method />
    </div>

    <div class="md__table_wrapper">
        <table class="md__table">
            <thead class="md__thead">
                <tr>
                    <th class="md__th">S/N</th>
                    <th class="md__th">NAME</th>
                    <th class="md__th">DATE</th>
                    <th class="md__th"></th>
                </tr>
            </thead>
            <tbody class="md__tbody">
                @php
                $rowId = 1;
                @endphp
                @foreach ($paymentMethods as $paymentMethod)
                    <tr wire:key="{{ $paymentMethod->id }}" class="md__tr">
                        <td class="md__td">{{ $rowId++ }}</td>
                        <td class="md__td">{{ $paymentMethod->name }}</td>
                        <td class="md__td">{{ date('d/m/Y', strtotime($paymentMethod->created_at)) }}</td>
                        <td class="md__td">
                            <div class="flex items-center gap-2">
                                <button wire:click="deletePayment({{$paymentMethod->id}})" 
                                        wire:confirm.prompt="Are you sure that you want to delete - {{ $paymentMethod->name }}?\n\nType DELETE to confirm|DELETE"
                                >
                                    <x-heroicon-o-trash class="size-5 text-red-500" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
