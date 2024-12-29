@props([
    'variant' => 'default'
])

@php
$variant = [
    'success' => 'text-green-500 dark:text-green-400 bg-green-500/20  border-green-200 dark:border-green-800 hover:border-green-300 dark:hover:border-green-700 hover:bg-green-600/20',
    'danger' => 'text-red-500 dark:text-red-400 bg-red-500/10  border-red-200 dark:border-red-800 hover:border-red-300 dark:hover:border-red-700 hover:bg-red-600/20',
    'default' => 'text-gray-500 dark:text-gray-400 bg-gray-500/10  border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-700 hover:bg-gray-600/20',
    'warning' => 'text-amber-500 dark:text-amber-400 bg-amber-500/10  border-amber-200 dark:border-amber-800 hover:border-amber-300 dark:hover:border-amber-700 hover:bg-amber-600/20'
][$variant];
@endphp

<button class="rounded-2xl outline-transparent cursor-pointer select-none px-3 py-0.5 text-sm {{ $variant }}"
   {{ $attributes }}
    >
    {{ $slot }}
</button>

