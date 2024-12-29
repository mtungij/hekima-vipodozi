<?php

use function Livewire\Volt\{state};

//

?>

<div>
    <div class="flex flex-col justify-center items-center text-center">
        <img src="{{ auth()->user()?->company->logo ? asset(path: "storage/" . auth()->user()->company->logo): asset('logo2.png')}}" 
                alt="{{ auth()->user()?->company?->name }}"
                class="justify-center size-20 rounded-lg"
        >
        <p class="text-gray-700 font-semibold text-2xl leading-tight uppercase">{{ auth()->user()->company->name }}</p>
        <p class="text-gray-700 text-lg">{{ auth()->user()?->company?->address }}</p>
        <p class="text-gray-700 text-lg">MOB.{{ auth()->user()?->company?->phone }}</p>
        <p class="text-gray-700 text-lg">Email: {{ auth()->user()?->company?->email }}</p>
    </div>
</div>
