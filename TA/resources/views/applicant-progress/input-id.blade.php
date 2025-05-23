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
                    href="{{ route('applicant.progress.index') }}"
                    class="inline-block px-5 py-1.5 text-gray-800 border border-gray-300 hover:border-gray-400 rounded-md text-sm leading-normal"
                >
                    Back to Periods
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
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $periode->nama_periode }}</h2>
                            <p class="text-sm text-gray-600">
                                {{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }}
                            </p>
                        </div>

                        <form action="{{ route('applicant.progress.track', $periode->periode_id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Enter your Application ID
                                </label>
                                <div class="flex">
                                    <input
                                        type="text"
                                        name="pelamar_id"
                                        id="pelamar_id"
                                        placeholder="e.g., PL001"
                                        class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    />
                                    <button
                                        type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-r-md"
                                    >
                                        Track Progress
                                    </button>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Enter the Application ID you received when you submitted your application.
                                </p>
                                @error('pelamar_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
