<!DOCTYPE html>
<html>
<head>
    <title>PDF Example</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-dvh p-6">
    <div class="px-2 py-8 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex flex-col">
                <img src="{{ auth()->user()->company->logo ? asset(path: "storage/" . auth()->user()->company->logo): asset('logo2.png')}}" 
                     alt="{{ auth()->user()?->company?->name }}"
                     class="justify-center"
                     >
                <p class="text-gray-700 font-semibold text-lg">SELENIUM TECH ENTERPRICES</p>
            </div>

            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2 uppercase">Invoice</div>
                <div class="text-sm">Date: 01/05/2023</div>
                <div class="text-sm">Invoice #: 66778</div>
            </div>
        </div>
        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Bill To:</h2>
            <p class="text-gray-700 mb-2">{{ "John Semela" }}</p>
            <p class="text-gray-700 mb-2">123 Main St.</p>
            <p class="text-gray-700 mb-2">Anytown, USA 12345</p>
            <p class="text-gray-700">johndoe@example.com</p>
        </div>
        <table class="w-full text-left mb-8 border border-collapse">
            <thead>
                <tr>
                    <th class="text-gray-700 font-bold border uppercase p-2">Description</th>
                    <th class="text-gray-700 font-bold border uppercase p-2">Quantity</th>
                    <th class="text-gray-700 font-bold border uppercase p-2">Price</th>
                    <th class="text-gray-700 font-bold border uppercase p-2">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2 text-gray-700 border">Product 1</td>
                    <td class="p-2 text-gray-700 border">1</td>
                    <td class="p-2 text-gray-700 border">$100.00</td>
                    <td class="p-2 text-gray-700 border">$100.00</td>
                </tr>
                <tr>
                    <td class="p-2 text-gray-700 border">Product 2</td>
                    <td class="p-2 text-gray-700 border">2</td>
                    <td class="p-2 text-gray-700 border">$50.00</td>
                    <td class="p-2 text-gray-700 border">$100.00</td>
                </tr>
                <tr>
                    <td class="p-2 text-gray-700 border">Product 3</td>
                    <td class="p-2 text-gray-700 border">3</td>
                    <td class="p-2 text-gray-700 border">$75.00</td>
                    <td class="p-2 text-gray-700 border">$225.00</td>
                </tr>
            </tbody>
        </table>
            <div class="flex justify-end mb-8">
                <div class="text-gray-700 mr-2">Subtotal:</div>
                <div class="text-gray-700">$425.00</div>
            </div>
            <div class="flex justify-end mb-8">
                <div class="text-gray-700 mr-2">Tax:</div>
                <div class="text-gray-700">$25.50</div>
            </div>
            <div class="flex justify-end mb-8">
                <div class="text-gray-700 mr-2">Total:</div>
                <div class="text-gray-700 font-bold border text-xl">$450.50</div>
            </div>
            <div class="border-t-2 border-gray-300 pt-8 mb-8">
                <div class="text-gray-700 mb-2">Payment is due within 30 days. Late payments are subject to fees.</div>
                <div class="text-gray-700 mb-2">Please make checks payable to Your Company Name and mail to:</div>
                <div class="text-gray-700">123 Main St., Anytown, USA 12345</div>
            </div>
    </div>
</body>
</html>
