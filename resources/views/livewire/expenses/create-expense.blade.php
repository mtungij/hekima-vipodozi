<div class="space-y-4 max-w-md">
    <div class="space-y-1.5 w-full" wire:lazy>
        <x-input-label for="payment_method_id" value="{{ __('Payment method') }}" />
        <select name="payment_method_id"
                wire:model="payment_method_id"
                class="w-full py-1.5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm"
                >
            <option value="">{{ __('Select payment method')}}</option>
            @foreach ($payments as $payment)
                <option wire:key="$payment->id" value="{{ $payment->id }}">{{ $payment->name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('payment_method_id')" class="mt-1" />
    </div>
    <div class="flex items-end gap-4 print:hidden">
         <div class="space-y-1.5 w-full">
            <x-input-label for="item" value="{{ __('Item') }}" />
            <x-text-input
                wire:model="item"
                id="item"
                name="item"
                type="text"
                class="mt-1 block w-full"
                placeholder="{{ __('') }}"
                required
            />
            <x-input-error :messages="$errors->get('item')" class="mt-1" />
        </div>
        <div class="space-y-1.5 w-full">
            <x-input-label for="cost" value="{{ __('Cost') }}" />
            <x-text-input
                wire:model="cost"
                id="cost"
                name="cost"
                type="number"
                class="mt-1 block w-full"
                placeholder="{{ __('') }}"
                required
            />
            <x-input-error :messages="$errors->get('cost')" class="mt-1" />
        </div>
        <div>
            <x-primary-button wire:click="store">{{__('Save')}}</x-primary-button>
        </div>
    </div>
</div>
