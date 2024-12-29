@props(['on' => true])

<div x-data="{ shown: false, timeout: null }"
     x-init="clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 3000);"
     x-show.transition.out.opacity.duration.2500ms="shown"
     x-transition:leave.opacity.duration.2500ms
     style="display: none;"
    {{ $attributes->merge(['class' => 'text-base p-2 text-center']) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>