@props([
    'show' => false,
    'variant' => 'default'
])

@php
$variant = [
    'success' => 'text-green-500 dark:text-green-400 bg-green-500/20 border border-green-400 dark:border-green-700 hover:border-green-400 dark:hover:border-green-600 hover:bg-green-600/20',
    'danger' => 'text-red-500 dark:text-red-400 bg-red-500/20 border border-red-400 dark:border-red-700 hover:border-red-400 dark:hover:border-red-600 hover:bg-slate-600/20',
    'default' => 'text-gray-500 dark:text-gray-400 bg-gray-500/20 border border-gray-400 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:bg-slate-600/20',
    'warning' => 'text-amber-500 dark:text-amber-400 bg-amber-500/20 border border-amber-400 dark:border-amber-700 hover:border-amber-400 dark:hover:border-amber-600 hover:bg-slate-600/20'
][$variant];
@endphp

<button class="rounded-2xl cursor-pointer select-none px-4 py-1 text-sm {{ $variant }}"
   {{ $attributes }}
    >
    {{ $slot }}
</button>
