<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Track Your Application Progress - JIWARAGA</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|poppins:400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .fade-in {
                animation: fadeIn 0.8s ease-in;
            }

            .slide-in-bottom {
                animation: slideInBottom 0.5s ease-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes slideInBottom {
                from { transform: translateY(30px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            .tracking-hero {
                background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
                color: white;
                min-height: 200px;
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            body {
                font-family: 'Poppins', sans-serif;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Instrument Sans', sans-serif;
            }

            .input-animation .input-icon {
                transition: all 0.3s ease;
            }

            .input-animation:focus-within .input-icon {
                color: #4F46E5;
            }

            .btn-primary {
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
            }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="text-xl font-bold text-indigo-600">JIWARAGA</a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('applicant.progress.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Periods
                        </a>
                    </div>
                </div>
            </div>
            </nav>

        <!-- Hero Section -->
        <section class="tracking-hero py-12 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 fade-in">Application Progress Tracker</h1>
                <p class="text-lg max-w-3xl mx-auto mb-4 opacity-90 fade-in">
                    Enter your application ID to track your progress
                </p>
                <div class="bg-white/10 backdrop-blur-sm inline-flex items-center px-4 py-1 rounded-full text-sm font-medium fade-in">
                    <i class="fas fa-calendar-check mr-2"></i>
                    <span>{{ $periode->nama_periode }}</span>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 flex-grow">
                @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md fade-in">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md fade-in">
                        {{ session('error') }}
                    </div>
                @endif

            <div class="bg-white shadow-md rounded-lg overflow-hidden slide-in-bottom">
                <div class="p-6">
                    <div class="text-center max-w-xl mx-auto">
                        <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-3xl text-indigo-600"></i>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-2xl font-semibold mb-2 text-gray-800">{{ $periode->nama_periode }}</h2>
                            <p class="text-gray-600 flex items-center justify-center">
                                <span class="inline-flex items-center mr-4">
                                    <i class="fas fa-calendar-day text-indigo-500 mr-2"></i>
                                    {{ $periode->tanggal_mulai->format('d M Y') }}
                                </span>
                                <span class="inline-flex items-center">
                                    <i class="fas fa-calendar-check text-indigo-500 mr-2"></i>
                                    {{ $periode->tanggal_selesai->format('d M Y') }}
                                </span>
                            </p>
                        </div>

                        <form action="{{ route('applicant.progress.track', $periode->periode_id) }}" method="POST" class="max-w-md mx-auto">
                            @csrf
                            <div>
                                <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Enter your Application ID
                                </label>
                                <div class="relative input-animation">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fas fa-id-card text-gray-400 input-icon"></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="pelamar_id"
                                        id="pelamar_id"
                                        placeholder="e.g., PL001"
                                        class="block w-full rounded-md border-gray-300 pl-10 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required
                                    />
                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                    <button
                                        type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-r-md btn-primary flex items-center"
                                    >
                                            <i class="fas fa-search-location mr-1"></i>
                                            Track
                                    </button>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 text-center">
                                    Enter the Application ID you received when you submitted your application
                                </p>
                                @error('pelamar_id')
                                    <p class="mt-1 text-sm text-red-600 text-center">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center text-gray-500 text-sm">
                <p>Don't have an Application ID? <a href="/" class="text-indigo-600 hover:text-indigo-500">Apply now</a></p>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-xl font-bold">JIWARAGA Job Application Portal</h2>
                        <p class="text-gray-400 mt-1">Find your job with us</p>
                    </div>
                    <div>
                        <a href="/" class="text-gray-300 hover:text-white transition">
                            Back to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add focus to the input field
                document.getElementById('pelamar_id').focus();

                // Add animations
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });
            });
        </script>
    </body>
</html>
