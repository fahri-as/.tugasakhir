<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JIWARAGA') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2280%22>J</text></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|poppins:400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Instrument Sans', sans-serif;
            }

            .fade-in {
                animation: fadeIn 0.8s ease-in forwards;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .slide-up {
                animation: slideUp 0.5s ease-out forwards;
            }

            @keyframes slideUp {
                from { transform: translateY(20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            .notification {
                animation: notification 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
            }

            @keyframes notification {
                0% { transform: translateY(20px); opacity: 0; }
                70% { transform: translateY(-5px); }
                100% { transform: translateY(0); opacity: 1; }
            }

            .content-wrapper {
                min-height: calc(100vh - 64px - 56px);
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 slide-up">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-grow content-wrapper">
                <div class="fade-in">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 py-4 text-center text-gray-500 text-sm mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p>© {{ date('Y') }} JIWARAGA - Job Application Management System</p>
                </div>
            </footer>
        </div>

        <!-- Success Notification -->
        @if(Session::has('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-8"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-8"
             x-init="setTimeout(() => show = false, 4000)"
             class="notification fixed bottom-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center z-50 max-w-md">
            <div class="flex-shrink-0 mr-3">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div class="flex-1 pr-4">
                <p class="font-medium">Success!</p>
                <p class="text-sm opacity-90">{{ Session::get('success') }}</p>
            </div>
            <button @click="show = false" class="text-white opacity-70 hover:opacity-100 transition-opacity">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        <!-- Error Notification -->
        @if(Session::has('error'))
        <div x-data="{ show: true }"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-8"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-8"
             x-init="setTimeout(() => show = false, 4000)"
             class="notification fixed bottom-4 right-4 bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center z-50 max-w-md">
            <div class="flex-shrink-0 mr-3">
                <i class="fas fa-exclamation-circle text-2xl"></i>
            </div>
            <div class="flex-1 pr-4">
                <p class="font-medium">Error!</p>
                <p class="text-sm opacity-90">{{ Session::get('error') }}</p>
            </div>
            <button @click="show = false" class="text-white opacity-70 hover:opacity-100 transition-opacity">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
    </body>
</html>
