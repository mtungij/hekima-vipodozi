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
                @foreach ($this->transfers as $transfer)
                    <tr class="md__tr" wire:key="$transfer->id">
                        <td class="md__td">{{ $transfer?->product?->name }}</td>
                        <td class="md__td">
                            <livewire:stock-transfers.edit-stock-transfer :key="$transfer->id" :item="$transfer" />
                        </td>
                        <td class="md__td">
                            <button wire:click="delete({{ $transfer->id }})"
                                    wire:confirm="Are you sure you want to delete this item? ">
                                <x-heroicon-o-trash class="size-5 hover:fill-current" />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @empty($this->transfers->items())
            <x-empty>{{__('No products to transfer!')}}</x-empty>
        @endempty
    </div>
    <div class="py-2">
        {{ $this->transfers->links() }}
    </div>

     <div class="flex items-end gap-4">
         <div class="space-y-1.5 w-full" wire:lazy>
            <x-input-label for="branch_id" value="{{ __('Transfer to branch') }}" />
            <select name="branch_id"
                    wire:model="branch_id"
                    wire:change="saveBranchId()"
                    class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm"
                    >
                <option @disabled($branch_id) value="">{{ __('To branch')}}</option>
                @foreach ($branches as $branch)
                    <option wire:key="$branch->id" value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('branch_id')" class="mt-1" />
         </div>

         <div>
            <x-primary-button wire:click="transfer">Transfer</x-primary-button>
         </div>
     </div>

</div>
