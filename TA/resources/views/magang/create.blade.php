<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-plus-circle text-indigo-600 mr-2"></i> {{ __('Create New Internship Record') }}
            </h2>
            <a href="{{ route('magang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-red-50" role="alert">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('magang.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-4 rounded-lg border border-indigo-100 shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-user-graduate text-indigo-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">New Internship Registration</h3>
                                    <p class="text-sm text-gray-600">Create a new internship record for an approved applicant</p>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information Section -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-5 rounded-lg border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-id-card text-indigo-600 mr-2"></i> Basic Information
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Internship ID -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="magang_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-hashtag text-gray-400 mr-1"></i> Internship ID
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-id-badge text-gray-400"></i>
                                        </div>
                                        <input type="text" name="magang_id" id="magang_id" required
                                               class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('magang_id') border-red-500 @enderror"
                                               placeholder="e.g., INT-2024-001"
                                               value="{{ old('magang_id') }}">
                                    </div>
                                    @error('magang_id')
                                        <p class="mt-1 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Unique identifier for this internship record</p>
                                </div>

                                <!-- Applicant Selection -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-user text-gray-400 mr-1"></i> Select Applicant
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-graduate text-gray-400"></i>
                                        </div>
                                        <select name="pelamar_id" id="pelamar_id" required
                                                class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('pelamar_id') border-red-500 @enderror">
                                            <option value="">Choose an approved applicant</option>
                                            @foreach($pelamar as $p)
                                                <option value="{{ $p->pelamar_id }}" {{ old('pelamar_id') == $p->pelamar_id ? 'selected' : '' }}
                                                        data-job="{{ $p->job->nama_job ?? 'No Job' }}"
                                                        data-period="{{ $p->periode->nama_periode ?? 'No Period' }}">
                                                    {{ $p->nama }} ({{ $p->job->nama_job ?? 'No Job' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('pelamar_id')
                                        <p class="mt-1 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Select from approved applicants only</p>
                                </div>
                            </div>

                            <!-- Applicant Preview Card -->
                            <div id="applicant-preview" class="hidden mt-6 p-4 bg-white rounded-lg border border-indigo-200 shadow-sm">
                                <h4 class="font-medium text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-eye text-indigo-600 mr-2"></i> Selected Applicant Preview
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Position:</span>
                                        <span id="preview-job" class="font-medium ml-2">-</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Period:</span>
                                        <span id="preview-period" class="font-medium ml-2">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Internship Details Section -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-5 rounded-lg border border-purple-200 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-clipboard-check text-purple-600 mr-2"></i> Internship Details
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Total Score -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="total_skor" class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-star text-gray-400 mr-1"></i> Total Score (0-5 scale)
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-chart-line text-gray-400"></i>
                                        </div>
                                        <input type="number" name="total_skor" id="total_skor" step="0.01" min="0" max="5" required
                                               class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('total_skor') border-red-500 @enderror"
                                               placeholder="e.g., 4.25"
                                               value="{{ old('total_skor') }}">
                                    </div>
                                    @error('total_skor')
                                        <p class="mt-1 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </p>
                                    @enderror

                                    <!-- Score Visualization -->
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>0</span>
                                            <span>2.5</span>
                                            <span>5</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div id="score-preview" class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Visual representation of the score</p>
                                    </div>
                                </div>

                                <!-- Selection Status -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="status_seleksi" class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-flag text-gray-400 mr-1"></i> Selection Status
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-tasks text-gray-400"></i>
                                        </div>
                                        <select name="status_seleksi" id="status_seleksi" required
                                                class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status_seleksi') border-red-500 @enderror">
                                            <option value="">Select Status</option>
                                            <option value="Pending" {{ old('status_seleksi') == 'Pending' ? 'selected' : '' }}>
                                                Pending - Waiting to start
                                            </option>
                                            <option value="Sedang Berjalan" {{ old('status_seleksi') == 'Sedang Berjalan' ? 'selected' : '' }}>
                                                Active - Currently ongoing
                                            </option>
                                            <option value="Lulus" {{ old('status_seleksi') == 'Lulus' ? 'selected' : '' }}>
                                                Completed - Successfully finished
                                            </option>
                                            <option value="Tidak Lulus" {{ old('status_seleksi') == 'Tidak Lulus' ? 'selected' : '' }}>
                                                Failed - Did not complete successfully
                                            </option>
                                        </select>
                                    </div>
                                    @error('status_seleksi')
                                        <p class="mt-1 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </p>
                                    @enderror

                                    <!-- Status Preview -->
                                    <div id="status-preview" class="mt-2 hidden">
                                        <div class="flex items-center">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full" id="status-badge"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Important Notes Section -->
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-lg border border-yellow-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-lightbulb text-yellow-600 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Important Notes</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li>Only approved applicants are available for selection</li>
                                            <li>Total score should reflect the overall performance assessment</li>
                                            <li>Status can be updated later as the internship progresses</li>
                                            <li>Make sure the Internship ID is unique and follows your naming convention</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('magang.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-gray-300 rounded-md font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-save mr-2"></i> Create Internship Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pelamarSelect = document.getElementById('pelamar_id');
            const applicantPreview = document.getElementById('applicant-preview');
            const previewJob = document.getElementById('preview-job');
            const previewPeriod = document.getElementById('preview-period');
            const totalSkorInput = document.getElementById('total_skor');
            const scorePreview = document.getElementById('score-preview');
            const statusSelect = document.getElementById('status_seleksi');
            const statusPreview = document.getElementById('status-preview');
            const statusBadge = document.getElementById('status-badge');

            // Show applicant preview when selected
            pelamarSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (this.value) {
                    const job = selectedOption.getAttribute('data-job');
                    const period = selectedOption.getAttribute('data-period');

                    previewJob.textContent = job;
                    previewPeriod.textContent = period;
                    applicantPreview.classList.remove('hidden');

                    // Add animation
                    applicantPreview.style.opacity = '0';
                    applicantPreview.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        applicantPreview.style.transition = 'all 0.3s ease-out';
                        applicantPreview.style.opacity = '1';
                        applicantPreview.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    applicantPreview.classList.add('hidden');
                }
            });

            // Update score visualization
            totalSkorInput.addEventListener('input', function() {
                const score = parseFloat(this.value) || 0;
                const percentage = Math.min((score / 5) * 100, 100);
                scorePreview.style.width = percentage + '%';

                // Change color based on score
                if (score < 2) {
                    scorePreview.className = 'bg-gradient-to-r from-red-500 to-rose-500 h-2 rounded-full transition-all duration-300';
                } else if (score < 3.5) {
                    scorePreview.className = 'bg-gradient-to-r from-yellow-500 to-orange-500 h-2 rounded-full transition-all duration-300';
                } else {
                    scorePreview.className = 'bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full transition-all duration-300';
                }
            });

            // Update status preview
            statusSelect.addEventListener('change', function() {
                const status = this.value;
                const statusText = this.options[this.selectedIndex].text.split(' - ')[0];

                if (status) {
                    statusBadge.textContent = statusText;

                    // Update badge style based on status
                    statusBadge.className = 'px-2 py-1 text-xs font-semibold rounded-full ';

                    switch(status) {
                        case 'Pending':
                            statusBadge.className += 'bg-yellow-100 text-yellow-800';
                            break;
                        case 'Sedang Berjalan':
                            statusBadge.className += 'bg-green-100 text-green-800';
                            break;
                        case 'Lulus':
                            statusBadge.className += 'bg-purple-100 text-purple-800';
                            break;
                        case 'Tidak Lulus':
                            statusBadge.className += 'bg-red-100 text-red-800';
                            break;
                    }

                    statusPreview.classList.remove('hidden');
                } else {
                    statusPreview.classList.add('hidden');
                }
            });

            // Initialize animations
            const animatedElements = document.querySelectorAll('.transform');
            animatedElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 50);
            });

            // Trigger existing selections on page load
            if (pelamarSelect.value) {
                pelamarSelect.dispatchEvent(new Event('change'));
            }
            if (totalSkorInput.value) {
                totalSkorInput.dispatchEvent(new Event('input'));
            }
            if (statusSelect.value) {
                statusSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>