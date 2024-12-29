@props(["url", "active"])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-2.5 block bg-cyan-500/40 p-1 rounded transition-all duration-150'
            : 'flex items-center gap-2.5 block p-1 rounded transition-all duration-150';
@endphp

<a href="{{ $url }}" 
   {{ $attributes->merge(['class' => $classes])}}
   wire:navigate
   >
    <div {{ $attributes->merge(["class" => "size-7 rounded-lg text-gray-400 dark:text-white"])}}
    >
        {{ $icon }}
    </div>
    <span class="text-gray-300 text-sm inline-block size-full {{ $active ? 'font-medium text-white' : 'hover:text-cyan-500'}}">{{ $slot }}</span>
</a>
