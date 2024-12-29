<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mauzodata System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-white min-h-dvh text-black/50 dark:bg-gray-950 dark:text-white/50">
            <header class="bg-teal-800 text-gray-50 py-2  sticky top-0 z-10">
                <nav class="max-w-6xl mx-auto flex justify-end items-center gap-4">
                    <a href="/" class="mr-auto">
                        <x-application-logo class="size-10" />
                    </a>

                    <a href="#pricing">Pricing</a>
                    <a href="#company">Our Company</a>
                    <livewire:welcome.navigation />
                </nav>
            </header>

            <div class="max-w-6xl mx-auto">
                <div class='relative'>
                    <img src="banner_2.png" class="w-full" alt="banner image" />

                    <div class="absolute top-1/2 bg-teal-950/60 p-4 mx-5 md:mx-0">
                        <p class="text-3xl lg:text-6xl text-balance text-white">Find your business, let's help you to sell</p>
                        <button class="bg-orange-600 text-gray-100 py-1 px-3 mt-2 hover:bg-orange-800">Book the demo</button>
                    </div>
                </div>
            </div>

            <main class="max-w-6xl space-y-10 mx-auto bg-gray-100 dark:bg-gray-900 px-6 py-20 md:py-6">
                <section>
                    <p class="text-lg">
                        <span class="text-teal-500">Mauzodata(MSI)</span> - Is a sales system made by kadolabs company that help business owners to manage their shops, stores, supermarkets, pharmacies etc.
                        It generates profit, capitals, expenses, employees sales and stocks inventory reports for you which gives you a general overview of your business more effiently without pain. This can help you to help you make 
                        business descision more easly.
                    </p>
                </section>

                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <img src="{{ asset('images/img_1.jpg')}}" alt="">
                    </div>
                    <div class="space-y-4">
                        <h2 class="text-xl dark:text-teal-100 text-teal-950">Why you should choose us</h2>
                        <p>
                            Mauzodata sales system offers a variety of features that can help you to manage your business:-
                        </p>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
