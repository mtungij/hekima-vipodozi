<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased overflow-hidden dark:bg-gray-950">
        <div x-data="{ sidebarOpen: $persist(true) }"  class="flex items-start w-full overflow-hidden bg-gray-100 dark:bg-gray-900/90 dark:text-gray-400">
            <nav class="hidden md:block print:hidden bg-cyan-950  sticky top-0 w-[300px] max-w-full p-2" 
                x-show="sidebarOpen == true" x-transition>
                <livewire:layout.sidebar />
            </nav>
            
            <div class="w-full max-w-full h-dvh overflow-auto print:overflow-hidden">
                <!-- Page Heading -->
                 <div class="z-40 sticky top-0 print:hidden">
                     <livewire:layout.navigation />
                 </div>
                @if (isset($header))
                    <header class="bg-cyan-800 text-white print:hidden">
                        <div class="py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                @session('success')
                   <x-toast class="text-white bg-green-600 absolute bottom-8 z-50 w-full max-w-sm shadow-lg rounded mx-8">{{ session('success')}}</x-toast>
                @endsession
                @session('error')
                   <x-toast class="text-gray-100 bg-red-400 absolute bottom-8 z-50 w-full max-w-sm shadow-xl rounded mx-8">{{ session('error')}}</x-toast>
                @endsession
    
                <!-- Page Content -->
                <main class="px-4 pb-8 max-w-full">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
