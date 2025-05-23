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
        </style>
    </head>
    <body class="bg-gray-50 text-gray-800 min-h-screen">
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
                        <a href="/" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-home mr-2"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="tracking-hero py-12 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 fade-in">Application Progress Tracker</h1>
                <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6 opacity-90 fade-in">
                    Track the status of your job application and monitor your progress through our recruitment process
                </p>
                <div class="max-w-md mx-auto bg-white/20 backdrop-blur-sm rounded-lg p-4 fade-in">
                    <div class="flex items-center justify-center text-center">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-search text-xl"></i>
                            <span>Select a recruitment period below to get started</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
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
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800 flex items-center">
                        <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>
                        Select Recruitment Period
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($periodes as $periode)
                            <a href="{{ route('applicant.progress.select-period', $periode->periode_id) }}"
                               class="block bg-white border rounded-lg shadow-sm hover:shadow-md card-hover">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $periode->nama_periode }}</h3>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            {{ $periode->tanggal_selesai->isPast() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $periode->tanggal_selesai->isPast() ? 'Closed' : 'Active' }}
                                        </span>
                                    </div>

                                    <div class="space-y-2">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-play-circle mr-2 text-indigo-500"></i>
                                            <span>{{ $periode->tanggal_mulai->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-flag-checkered mr-2 text-indigo-500"></i>
                                            <span>{{ $periode->tanggal_selesai->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="mt-6 text-center">
                                        <span class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-md hover:bg-indigo-100 transition-colors">
                                            <i class="fas fa-search mr-2"></i> Track Application
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-auto">
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
                // Add animations
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('.card-hover').forEach(card => {
                    observer.observe(card);
                });
            });
        </script>
    </body>
</html>
