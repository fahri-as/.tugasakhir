<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Track Your Application Progress</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 text-gray-800 flex p-6 lg:p-8 items-center min-h-screen flex-col">
        <header class="w-full max-w-7xl text-sm mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Application Progress Tracker</h1>
            </div>
            <nav class="flex items-center justify-end gap-4">
                <a
                    href="/"
                    class="inline-block px-5 py-1.5 text-gray-800 border border-gray-300 hover:border-gray-400 rounded-md text-sm leading-normal"
                >
                    Back to Home
                </a>
            </nav>
        </header>

        <div class="flex items-center justify-center w-full">
            <main class="w-full max-w-7xl">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-semibold mb-6 text-gray-800">Select Recruitment Period</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($periodes as $periode)
                                <a href="{{ route('applicant.progress.select-period', $periode->periode_id) }}"
                                   class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50">
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900">{{ $periode->nama_periode }}</h3>
                                    <p class="text-sm text-gray-600 mb-1">
                                        Start: {{ $periode->tanggal_mulai->format('d M Y') }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        End: {{ $periode->tanggal_selesai->format('d M Y') }}
                                    </p>
                                    <div class="mt-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $periode->tanggal_selesai->isPast() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $periode->tanggal_selesai->isPast() ? 'Closed' : 'Active' }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
