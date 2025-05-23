<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Job Application Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|poppins:400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts -->
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

            .hero-section {
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixlib=rb-4.0.3');
                background-size: cover;
                background-position: center;
                height: 50vh;
                color: white;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                position: relative;
            }

            .feature-card {
                transition: all 0.3s ease;
                border-radius: 8px;
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .btn-primary {
                background-color: #3B82F6;
                color: white;
                transition: all 0.3s ease;
                font-weight: 600;
            }

            .btn-primary:hover {
                background-color: #2563EB;
                transform: scale(1.02);
            }

            .btn-outline {
                border: 2px solid #3B82F6;
                color: #3B82F6;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .btn-outline:hover {
                background-color: #3B82F6;
                color: white;
            }

            body {
                font-family: 'Poppins', sans-serif;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Instrument Sans', sans-serif;
            }

            .form-container {
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                border-radius: 12px;
            }

            .wave-divider {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                overflow: hidden;
                line-height: 0;
            }

            .wave-divider svg {
                position: relative;
                display: block;
                width: calc(100% + 1.3px);
                height: 65px;
            }

            .wave-divider .shape-fill {
                fill: #F3F4F6;
            }
        </style>
    </head>
    <body class="bg-gray-100 text-gray-800 min-h-screen">
        <!-- Hero Section -->
        <section class="hero-section relative">
            <div class="container mx-auto px-6 z-10 fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Build Your Career With Us</h1>
                <p class="text-xl md:text-2xl max-w-2xl mx-auto mb-8">Find and apply for exciting career opportunities that match your skills and aspirations</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary px-6 py-3 rounded-lg">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i> Log in
                            </a>
                        @endauth
                        <a href="{{ route('applicant.progress.index') }}" class="btn-outline px-6 py-3 rounded-lg">
                            <i class="fas fa-tasks mr-2"></i> Track Application
                        </a>
                    @endif
                </div>
            </div>
            <div class="wave-divider">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                </svg>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12 slide-in-bottom">Why Join Our Team?</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="feature-card bg-white p-6 rounded-lg shadow-sm slide-in-bottom" style="animation-delay: 0.1s">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-500 text-2xl mb-4">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Career Growth</h3>
                        <p class="text-gray-600">Opportunities for professional development and advancement in your career path</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card bg-white p-6 rounded-lg shadow-sm slide-in-bottom" style="animation-delay: 0.2s">
                        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-green-500 text-2xl mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Collaborative Team</h3>
                        <p class="text-gray-600">Work with talented professionals in a supportive and innovative environment</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card bg-white p-6 rounded-lg shadow-sm slide-in-bottom" style="animation-delay: 0.3s">
                        <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-500 text-2xl mb-4">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Competitive Benefits</h3>
                        <p class="text-gray-600">Enjoy great compensation packages and benefits designed for your wellbeing</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Application Form Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <h2 class="text-3xl font-bold mb-4">Apply For a Position</h2>
                    <p class="text-xl text-gray-600">Take the next step in your career journey by applying for one of our open positions</p>
                </div>

                <div class="form-container bg-white max-w-5xl mx-auto">
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

                    <form action="{{ route('pelamar.public.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
                        @csrf

                        <!-- Application Details Section -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                <i class="fas fa-clipboard-list text-blue-500 mr-2"></i>
                                Application Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Period Selection -->
                                <div>
                                    <label for="periode_id" class="block text-sm font-medium text-gray-700">Period</label>
                                    <select name="periode_id" id="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="">Select Period</option>
                                        @php
                                            // Filter out periods that have already ended and sort by start date (newest first)
                                            $activePeriodes = $periodes->filter(function($periode) {
                                                return $periode->tanggal_selesai->greaterThanOrEqualTo(now());
                                            })->sortByDesc('tanggal_mulai');
                                        @endphp

                                        @foreach($activePeriodes as $periode)
                                            <option value="{{ $periode->periode_id }}" {{ old('periode_id') == $periode->periode_id ? 'selected' : '' }}
                                                data-jobs="{{ json_encode($periode->jobs) }}">
                                                {{ $periode->nama_periode }} ({{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('periode_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Job Selection -->
                                <div>
                                    <label for="job_id" class="block text-sm font-medium text-gray-700">Position Applied</label>
                                    <select name="job_id" id="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required disabled>
                                        <option value="">Select Period First</option>
                                    </select>
                                    @error('job_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information Section -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                <i class="fas fa-user text-green-500 mr-2"></i>
                                Personal Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- WhatsApp Number -->
                                <div>
                                    <label for="nomor_wa" class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                                    <input type="text" name="nomor_wa" id="nomor_wa" value="{{ old('nomor_wa') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('nomor_wa')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('tgl_lahir')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Address</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Education & Experience Section -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                <i class="fas fa-graduation-cap text-purple-500 mr-2"></i>
                                Education & Experience
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Education -->
                                <div>
                                    <label for="pendidikan" class="block text-sm font-medium text-gray-700">Education</label>
                                    <select name="pendidikan" id="pendidikan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="">Select Education Level</option>
                                        <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                    @error('pendidikan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Experience Duration -->
                                <div>
                                    <label for="lama_pengalaman" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                                    <input type="number" name="lama_pengalaman" id="lama_pengalaman" value="{{ old('lama_pengalaman', 0) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('lama_pengalaman')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Previous Workplace -->
                                <div>
                                    <label for="tempat_pengalaman" class="block text-sm font-medium text-gray-700">Previous Workplace</label>
                                    <input type="text" name="tempat_pengalaman" id="tempat_pengalaman" value="{{ old('tempat_pengalaman') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    @error('tempat_pengalaman')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Workplace Description -->
                                <div class="md:col-span-2">
                                    <label for="deskripsi_tempat" class="block text-sm font-medium text-gray-700">Workplace Description</label>
                                    <textarea name="deskripsi_tempat" id="deskripsi_tempat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('deskripsi_tempat') }}</textarea>
                                    @error('deskripsi_tempat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- CV Upload Section -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                <i class="fas fa-file-alt text-orange-500 mr-2"></i>
                                Document Upload
                            </h3>
                            <div class="grid grid-cols-1 gap-6">
                                <!-- CV File Upload -->
                                <div>
                                    <label for="berkas_cv" class="block text-sm font-medium text-gray-700">Upload CV (Max 500KB)</label>
                                    <input type="file" name="berkas_cv" id="berkas_cv" accept=".pdf,.doc,.docx" class="mt-1 block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                                    <p class="mt-1 text-xs text-gray-500">Accepted formats: PDF, DOC, DOCX (Max size: 500KB)</p>
                                    @error('berkas_cv')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-center mt-6">
                            <button type="submit" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent rounded-lg font-semibold text-base tracking-wider">
                                <i class="fas fa-paper-plane mr-2"></i> Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-2xl font-bold">Job Application Portal</h2>
                        <p class="text-gray-400 mt-2">Find your dream job with us</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-linkedin-in text-xl"></i></a>
                        <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Job Application Portal. All rights reserved.
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const periodeSelect = document.getElementById('periode_id');
                const jobSelect = document.getElementById('job_id');

                // Initialize jobs if periode is already selected (e.g. when validation fails and page is reloaded)
                if (periodeSelect.value) {
                    updateJobOptions();
                }

                periodeSelect.addEventListener('change', updateJobOptions);

                function updateJobOptions() {
                    // Clear job dropdown
                    jobSelect.innerHTML = '<option value="">Select Position</option>';

                    if (periodeSelect.value === '') {
                        jobSelect.disabled = true;
                        return;
                    }

                    // Get selected option
                    const selectedOption = periodeSelect.options[periodeSelect.selectedIndex];
                    // Get jobs data from data attribute
                    const jobs = JSON.parse(selectedOption.getAttribute('data-jobs') || '[]');

                    if (jobs && jobs.length > 0) {
                        // Populate job dropdown
                        jobs.forEach(job => {
                            const option = document.createElement('option');
                            option.value = job.job_id;
                            option.textContent = `${job.nama_job} - ${job.deskripsi || ''}`;

                            // Check if job was previously selected
                            if (job.job_id === '{{ old("job_id") }}') {
                                option.selected = true;
                            }

                            jobSelect.appendChild(option);
                        });

                        // Enable job dropdown
                        jobSelect.disabled = false;
                    } else {
                        // No jobs available for this period
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No positions available for this period';
                        jobSelect.appendChild(option);
                        jobSelect.disabled = true;
                    }
                }

                // Add scroll animations
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('fade-in');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('.feature-card').forEach(card => {
                    observer.observe(card);
                });
            });
        </script>
    </body>
</html>
