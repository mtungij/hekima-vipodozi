<div>
    <div class="md__table_wrapper">
        <table class="md__table">
            <thead class="md__thead">
                <tr>
                    <th class="md__th text-left">{{ __('Product') }}</th>
                    <th class="md__th text-left">{{ __('Stock')}}</th>
                    <th class="md__th"></th>
                </tr>
            </thead>
            <tbody class="md__tbody">
                @foreach ($this->newStocks as $newstock)
                    <tr class="md__tr" wire:key="$newstock->id">
                        <td class="md__td">{{ $newstock?->product?->name }}</td>
                        <td class="md__td">
                            <livewire:new-stocks.edit-stock-new-stock :key="$newstock->id" :item="$newstock" />
                        </td>
                        <td class="md__td">
                            <button wire:click="delete({{ $newstock->id }})"
                                    wire:confirm="Are you sure you want to delete this item? ">
                                <x-heroicon-o-trash class="size-5 hover:fill-current" />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @empty($this->newStocks->items())
            <x-empty>{{__('No new stocks!')}}</x-empty>
        @endempty
    </div>
    <div class="py-2">
        {{ $this->newStocks->links() }}
    </div>

     <div class="pt-8 max-w-xs">
         <x-primary-button wire:click="newstock"
            class="w-full justify-center font-semibold"
            >{{__('submit')}}</x-primary-button>
     </div>

</div>
