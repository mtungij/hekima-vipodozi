<button wire:loading.attr="disabled" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center text-sm px-4 py-2 bg-cyan-800 dark:bg-cyan-600 border border-transparent rounded text-white hover:bg-cyan-700 dark:hover:bg-cyan-500 disabled:bg-cyan-600/40 disabled:hover:bg-cyan-600/40 disabled:text-white/50 focus:bg-cyan-700 dark:focus:bg-cyan-500 active:bg-cyan-900 dark:active:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-cyan-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
