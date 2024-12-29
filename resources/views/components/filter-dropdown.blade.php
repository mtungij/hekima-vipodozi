<div class="relative" x-data="{ open: false, selected: 2 }">
    <button class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150" aria-label="Select date range" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
        <span class="flex items-center">
            <x-heroicon-m-funnel class="size-4 mr-2" />
            <span x-text="$refs.options.children[selected].children[1].innerHTML"></span>
        </span>
        <x-heroicon-m-chevron-down class="size-4 " />
    </button>
    <div class="absolute w-full bg-white rounded mt-1 shadow dark:bg-gray-800 border border-gray-200 dark:border-gray-700" 
            @click.outside="open = false" 
            @keydown.escape.window="open = false" 
            x-show="open" 
            x-collapsible>
        <div class="text-sm space-y-2" x-ref="options">
            <button tabindex="0" class="flex items-center" :class="selected === 0 'text-teal-500'" @click="selected = 0;open = false" @focus="open = true" @focusout="open = false">
                <svg class="mr-2 text-teal-500 cbm9w coqgc" :class="selected !== 0 &amp;&amp; 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                    <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z"></path>
                </svg>
                <span>Today</span>
            </button>
            <button tabindex="0" class="flex items-center" :class="selected === 1 &amp;&amp; 'text-teal-500'" @click="selected = 1;open = false" @focus="open = true" @focusout="open = false">
                <svg class="mr-2 text-teal-500 cbm9w coqgc" :class="selected !== 1 &amp;&amp; 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                    <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z"></path>
                </svg>
                <span>Last 7 Days</span>
            </button>
            <button tabindex="0" class="flex items-center" :class="selected === 2 &amp;&amp; 'text-teal-500'" @click="selected = 2;open = false" @focus="open = true" @focusout="open = false">
                <svg class="mr-2 text-teal-500 cbm9w coqgc" :class="selected !== 2 &amp;&amp; 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                    <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z"></path>
                </svg>
                <span>Last Month</span>
            </button>
            <button tabindex="0" class="flex items-center" :class="selected === 3  'text-teal-500'" @click="selected = 3;open = false" @focus="open = true" @focusout="open = false">
                <svg class="mr-2 text-teal-500 cbm9w coqgc" :class="selected !== 3 &amp;&amp; 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                    <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z"></path>
                </svg>
                <span>Last 12 Months</span>
            </button>
            <button tabindex="0" class="flex items-center" :class="selected === 4 &amp;&amp; 'text-teal-500'" @click="selected = 4;open = false" @focus="open = true" @focusout="open = false">
                <svg class="mr-2 text-teal-500 cbm9w coqgc" :class="selected !== 4 &amp;&amp; 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                    <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z"></path>
                </svg>
                <span>All Time</span>
            </button>
        </div>
    </div>
</div>