<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-plus-circle text-indigo-600 mr-2"></i> {{ __('Create Weekly Evaluation') }}
            </h2>
            <a href="{{ route('evaluasi.index', request()->has('periode_id') ? ['periode_id' => request('periode_id')] : []) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-red-50" role="alert">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('evaluasi.store') }}">
                        @csrf

                        <!-- Evaluation Information Section -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-5 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-clipboard-check text-indigo-600 mr-2"></i> Evaluation Information
                            </h3>

                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                                <!-- Magang (Intern) Selection -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="magang_id" class="block text-sm font-medium text-gray-700 mb-1">Select Intern</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-graduate text-gray-400"></i>
                                        </div>
                                        <select id="magang_id" name="magang_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('magang_id') border-red-500 @enderror" required>
                                            <option value="">Select Intern</option>
                                            @foreach($magang as $intern)
                                                <option value="{{ $intern->magang_id }}" @if(old('magang_id') == $intern->magang_id) selected @endif>
                                                    {{ $intern->pelamar->nama }} - {{ $intern->pelamar->job->nama_job ?? 'No Job' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('magang_id')
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Week Number -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="minggu_ke" class="block text-sm font-medium text-gray-700 mb-1">Week Number</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-week text-gray-400"></i>
                                        </div>
                                        <input type="number" id="minggu_ke" name="minggu_ke" min="1" value="{{ old('minggu_ke', $selectedWeek ?? '') }}" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('minggu_ke') border-red-500 @enderror" required>
                                    </div>
                                    @error('minggu_ke')
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Criteria & Rating Section -->
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-5 rounded-lg border border-indigo-100 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-tasks text-indigo-600 mr-2"></i> Evaluation Criteria
                            </h3>

                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                                <!-- Criteria Selection -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="criteria_id" class="block text-sm font-medium text-gray-700 mb-1">Criteria (Optional)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-list-ul text-gray-400"></i>
                                        </div>
                                        <select id="criteria_id" name="criteria_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('criteria_id') border-red-500 @enderror">
                                            <option value="">No specific criteria</option>
                                            @foreach($criteria as $criteriaItem)
                                                <option value="{{ $criteriaItem->criteria_id }}" @if(old('criteria_id') == $criteriaItem->criteria_id) selected @endif>
                                                    {{ $criteriaItem->name }} ({{ $criteriaItem->code }}) - {{ $criteriaItem->job->nama_job }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('criteria_id')
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Rating Selection -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="criteria_rating_id" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-star text-gray-400"></i>
                                        </div>
                                        <select id="criteria_rating_id" name="criteria_rating_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">Not Rated Yet</option>
                                        </select>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 italic">Select a criteria first to see available ratings</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('evaluasi.index', request()->has('periode_id') ? ['periode_id' => request('periode_id')] : []) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3 transform hover:scale-105">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-save mr-2"></i> Create Evaluation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const magangSelect = document.getElementById('magang_id');
            const criteriaSelect = document.getElementById('criteria_id');
            const ratingSelect = document.getElementById('criteria_rating_id');
            const csrfToken = "{{ csrf_token() }}";

            // Store all ratings by criteria ID
            const allRatings = {};

            // Function to filter criteria based on selected intern's job
            function filterCriteria() {
                // Get selected intern's option
                const selectedOption = magangSelect.options[magangSelect.selectedIndex];

                if (selectedOption && selectedOption.value) {
                    // Extract job ID from the text (assuming format: "Name - Job")
                    const text = selectedOption.text;
                    const jobPart = text.split('-')[1]?.trim();

                    if (jobPart) {
                        // Hide criteria that don't match the job
                        Array.from(criteriaSelect.options).forEach(option => {
                            if (option.value === '') return; // Skip "No specific criteria" option

                            const criteriaJob = option.text.split('-')[1]?.trim();

                            if (criteriaJob && criteriaJob !== jobPart) {
                                option.style.display = 'none';
                            } else {
                                option.style.display = '';
                            }
                        });
                    }
                }
            }

            // Preload all ratings for all criteria
            async function preloadAllRatings() {
                // Get all criteria IDs
                const criteriaIds = Array.from(criteriaSelect.options)
                    .filter(option => option.value) // Filter out empty value options
                    .map(option => option.value);

                // If no criteria, return
                if (criteriaIds.length === 0) return;

                // Show loading state
                ratingSelect.innerHTML = '<option value="">Loading ratings...</option>';

                // For each criteria, fetch ratings
                const fetchPromises = criteriaIds.map(criteriaId =>
                    fetch(`/api/criteria-ratings?criteria_id=${criteriaId}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Store ratings for this criteria
                            allRatings[criteriaId] = data.ratings;
                        }
                    })
                    .catch(error => {
                        console.error(`Error loading ratings for criteria ${criteriaId}:`, error);
                    })
                );

                // Wait for all fetches to complete
                await Promise.all(fetchPromises);

                // Reset rating dropdown
                ratingSelect.innerHTML = '<option value="">Not Rated Yet</option>';

                // If there's a selected criteria, populate its ratings
                if (criteriaSelect.value) {
                    populateRatings(criteriaSelect.value);
                }
            }

            // Function to populate ratings for a specific criterion from preloaded data
            function populateRatings(criteriaId) {
                // Clear the rating dropdown
                ratingSelect.innerHTML = '<option value="">Not Rated Yet</option>';

                if (!criteriaId) return;

                // If we have ratings for this criteria, populate them
                if (allRatings[criteriaId]) {
                    allRatings[criteriaId].forEach(rating => {
                        const option = document.createElement('option');
                        option.value = rating.id;
                        option.textContent = `${rating.name} - Level: ${rating.rating_level}`;
                        ratingSelect.appendChild(option);
                    });
                }
            }

            // Filter criteria on load
            filterCriteria();

            // Filter criteria when intern selection changes
            magangSelect.addEventListener('change', filterCriteria);

            // Load ratings when criterion selection changes
            criteriaSelect.addEventListener('change', function() {
                populateRatings(this.value);
            });

            // Preload all ratings when the page loads
            preloadAllRatings();
        });
    </script>
</x-app-layout>