<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-100 via-gray-200 to-gray-100">
            <div class="transform hover:scale-105 transition-transform duration-300">
                <a href="/" class="flex items-center justify-center">
                    <x-application-logo class="w-24 h-24 fill-current text-gray-600" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-6 overflow-hidden">
                <div class="backdrop-blur-sm bg-white/90 shadow-[0_8px_30px_rgb(0,0,0,0.12)] rounded-xl p-6">
                    {{ $slot }}
                </div>
            </div>

            <div class="mt-8 text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
