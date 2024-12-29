<div>
    <x-secondary-button 
        x-data="" 
        x-on:click.prevent="$dispatch('open-modal', 'filter-product-by-branch-modal')" maxWidth="lg"          
    >
        <span class="flex items-center">
            <x-heroicon-o-funnel class="size-4 mr-2" />
            <span>{{ __('Switch branch')}}</span>
        </span>
        <x-heroicon-m-chevron-up-down class="size-4 " />
    </x-secondary-button>
    <x-modal name="filter-product-by-branch-modal" :show="$errors->isNotEmpty()" focusable>
        <div class="grid gap-4 p-6 ">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Switch branch') }}
            </h2>

             <x-text-input type="search" name="search" wire:model.live.debounce.1000ms="search" placeholder="Search branch ..." />

            <div class="space-y-4 overflow-x-auto whitespace-nowrap">
                <table class="w-full border-collapse border dark:border-gray-700">
                    <thead class="dark:text-gray-300">
                        <tr>
                            <th class="p-2 text-xs text-left uppercase border dark:border-gray-700">{{__('Name')}}</th>
                            <th class="p-2 text-xs text-left border dark:border-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 dark:text-gray-400">
                    @foreach ($this->branches as $branch)
                        <tr wire:key="{{ $branch->id }}" class="transition-colors {{ auth()->user()->branch_id == $branch->id ? 'bg-gray-200/90 dark:bg-gray-700/50': ''}} hover:bg-gray-200/90 dark:hover:bg-gray-700/50">
                            <td class="p-2 text-sm text-left border dark:border-gray-700">{{ $branch->name }}</td>
                            <td class="p-2 text-sm border dark:border-gray-700">
                                <div class="flex items-center gap-2">
                                    <button wire:click="switchBranch({{$branch->id}})" class="text-teal-500 underline underline-offset-4">{{ __('switch') }}</button>
                                    
                                    @if (auth()->user()->branch_id == $branch->id)
                                       <x-heroicon-m-rss class="size-5 text-green-500" />
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="my-2">
                {{ $this->branches()->links() }}
            </div>
        </div>

         <div class="flex justify-center mb-6">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Close') }}
            </x-secondary-button>
        </div>
    </x-modal>
</div>
