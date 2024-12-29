<div clss="w-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('All Reports')}}
        </h2>
    </x-slot>

    <div class="py-6 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <a href="{{ route('user-sales')}}" wire:navigate class="flex items-center gap-4 bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            <div>
                <x-heroicon-o-document-chart-bar class="size-14 text-cyan-400" />
            </div>
            <div>Sellers Report</div>
        </a>
    </div>
</div>

