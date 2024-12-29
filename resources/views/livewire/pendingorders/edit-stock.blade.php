
<div>
    <button class="flex items-center gap-1"
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'edit-order-item-qty{{ $id }}')"
    >
    <x-heroicon-o-pencil-square class="size-6 text-teal-500 hover:fill-current" />
</button>

<x-modal name="edit-order-item-qty{{ $id }}" :show="$errors->isNotEmpty()" focusable>
        <div class="p-4 flex items-center justify-between gap-4">
            <p class="text-xl font-semibold">ORDER NO. {{ $id }}</p>
            <x-secondary-button @click="$dispatch('close')">Close</x-secondary-button>
        </div>
        <div class="overflow-auto">
            <table class="md__table">
                <thead class="md__thead">
                    <tr>
                        <th class="md__th"></th>
                        <th class="md__th text-left">{{ __('Product')}}</th>
                        <th class="md__th text-right">{{ __('Qty')}}</th>
                        <th class="md__th text-right">{{ __('Sold')}}</th>
                        <th class="md__th text-right">{{ __('Balance')}}</th>
                        <th class="md__th"></th>
                    </tr>
                </thead>
                <tbody class="md__tbody">
                    @foreach ($orderItems as $orderItem)
                        <tr class="md__tr" wire:key="$orderItem->id">
                            <td class="md__td"></td>
                            <td class="md__td">{{$orderItem?->product?->name}}</td>
                            <td class="md__td text-right">{{ $orderItem->v_qty }}</td>
                            <td class="md__td text-right flex justify-end">
                                <livewire:pendingorders.edit-item-qty :key="$orderItem->id" :item="$orderItem" />
                            </td>
                            <td class="md__td text-right">{{ number_format($orderItem->v_balance, 2) }}</td>
                            <td class="md__td"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-center p-4">
            <x-primary-button wire:click="approve({{ $id }})">{{__('Approve order')}}</x-primary-button>
        </div>
    </x-modal>

</div>
