<div>
    <button wire:click="begin" class="block mb-4">Start count-down</button>
    <h1 class="text-3xl font-bold">Count: <span wire:stream="count">{{ $start }}</span></h1>
</div>