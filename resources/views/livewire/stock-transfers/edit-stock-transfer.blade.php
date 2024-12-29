<div>
    <input type="text" 
        class="py-0.5 max-w-24 text-right px-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm"
        wire:model.live.debounce.1000ms="stock"
        wire:blur="updateItem"
        x-data
        x-mask:dynamic="$money($input)"
        class="max-w-24 py-0" />
    <x-input-error :messages="$errors->get('stock')" class="mt-1" />
</div>
