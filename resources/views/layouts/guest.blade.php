<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mauzodata') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .bg-image {
                background-image: url({{ asset('bg.jpg')}});
                background-position:center;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 ">
        <div class="bg-image min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center">
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>

                <p class="text-xl text-teal-700">Pharmacy System</p>
            </div>

            <div class="w-full sm:max-w-sm mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
