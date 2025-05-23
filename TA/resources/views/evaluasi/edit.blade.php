<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-edit text-indigo-600 mr-2"></i> {{ __('Edit Weekly Evaluation') }}
            </h2>
            <a href="{{ route('evaluasi.show', $evaluasi) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Back to Details
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

                    <form id="evaluationForm" method="POST" action="{{ route('evaluasi.update', $evaluasi) }}" onsubmit="return validateForm()">
                        @csrf
                        @method('PUT')

                        <!-- Debug info - hidden but helpful for troubleshooting -->
                        <input type="hidden" name="debug_id" value="{{ $evaluasi->evaluasi_id }}">
                        <input type="hidden" name="debug_timestamp" value="{{ time() }}">

                        <!-- Current Evaluation Info -->
                        <div class="mb-6 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-lg p-4 border border-indigo-100 shadow-sm">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-info-circle text-indigo-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Editing Evaluation</h3>
                                    <p class="text-sm text-gray-600">ID: {{ $evaluasi->evaluasi_id }} | Created: {{ $evaluasi->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Evaluation Information Section -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-5 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-clipboard-check text-indigo-600 mr-2"></i> Evaluation Information
                            </h3>

                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                                <!-- Magang (Intern) Selection -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="magang_id" class="block text-sm font-medium text-gray-700 mb-1">Intern</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-graduate text-gray-400"></i>
                                        </div>
                                        <select id="magang_id" name="magang_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('magang_id') border-red-500 @enderror" required>
                                            <option value="">Select Intern</option>
                                            @foreach($magang as $intern)
                                                <option value="{{ $intern->magang_id }}" @if(old('magang_id', $evaluasi->magang_id) == $intern->magang_id) selected @endif>
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
                                        <input type="number" id="minggu_ke" name="minggu_ke" min="1" value="{{ old('minggu_ke', $evaluasi->minggu_ke) }}" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('minggu_ke') border-red-500 @enderror" required>
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
                                                <option value="{{ $criteriaItem->criteria_id }}"
                                                        @if(old('criteria_id', $evaluasi->criteria_id) == $criteriaItem->criteria_id) selected @endif
                                                        data-job-id="{{ $criteriaItem->job_id }}">
                                                    {{ $criteriaItem->name }} ({{ $criteriaItem->code }}) - {{ $criteriaItem->job->nama_job }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Hidden input to preserve the original criteria_id if no new one is selected -->
                                    <input type="hidden" name="original_criteria_id" value="{{ $evaluasi->criteria_id }}">

                                    @error('criteria_id')
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-sm text-gray-500 mt-1 bg-yellow-50 p-2 rounded-md border border-yellow-200">
                                        <i class="fas fa-info-circle text-yellow-600 mr-1"></i>
                                        Current criteria: <strong>{{ $evaluasi->criteria->name ?? 'No specific criteria' }}</strong>
                                    </p>
                                </div>

                                <!-- Rating Selection -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="criteria_rating_id" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-star text-gray-400"></i>
                                        </div>
                                        <select id="criteria_rating_id" name="criteria_rating_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('criteria_rating_id') border-red-500 @enderror">
                                            <option value="">Not Rated Yet</option>
                                        </select>
                                    </div>
                                    @error('criteria_rating_id')
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                    <div id="smart-preview-status" class="hidden"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <form action="{{ route('evaluasi.destroy', $evaluasi) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this evaluation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                    <i class="fas fa-trash mr-2"></i> Delete
                                </button>
                            </form>

                            <div class="flex items-center space-x-3">
                                <a href="{{ route('evaluasi.show', $evaluasi) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                    <i class="fas fa-save mr-2"></i> Update Evaluation
                                </button>
                            </div>
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
            const originalCriteriaId = "{{ $evaluasi->criteria_id }}";
            const originalRatingId = "{{ $evaluasi->criteria_rating_id }}";
            const csrfToken = "{{ csrf_token() }}";
            const evaluasiId = "{{ $evaluasi->evaluasi_id }}";

            // Store all ratings by criteria ID
            const allRatings = {};

            // Function to load ratings for a specific criterion
            async function preloadAllRatings() {
                // Get all criteria IDs
                const criteriaIds = Array.from(criteriaSelect.options)
                    .filter(option => option.value) // Filter out empty value options
                    .map(option => option.value);

                // Add the original criteria ID if it's not in the list
                if (originalCriteriaId && !criteriaIds.includes(originalCriteriaId)) {
                    criteriaIds.push(originalCriteriaId);
                }

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

                // Populate ratings for the current criteria
                populateRatings(criteriaSelect.value || originalCriteriaId);
            }

            // Function to populate ratings from preloaded data
            function populateRatings(criteriaId) {
                if (!criteriaId) {
                    // If no criterion selected, clear the rating dropdown
                    ratingSelect.innerHTML = '<option value="">Not Rated Yet</option>';
                    return;
                }

                // Clear the rating dropdown
                ratingSelect.innerHTML = '<option value="">Not Rated Yet</option>';

                // If we have ratings for this criteria, populate them
                if (allRatings[criteriaId]) {
                    allRatings[criteriaId].forEach(rating => {
                        const option = document.createElement('option');
                        option.value = rating.id;
                        option.textContent = `${rating.name} - Level: ${rating.rating_level}`;

                        // Select the current rating if it matches
                        if (rating.id == originalRatingId) {
                            option.selected = true;
                        }

                        ratingSelect.appendChild(option);
                    });
                }
            }

            // Function to filter criteria based on selected intern's job
            function filterCriteria() {
                // Get the selected intern
                const selectedInternId = magangSelect.value;
                if (!selectedInternId) return;

                // Find the selected option to get job info
                const selectedOption = magangSelect.options[magangSelect.selectedIndex];
                const internText = selectedOption.text;

                // Try to extract the job name from intern text (format: "Name - Job")
                const jobMatch = internText.match(/- ([^-]+)$/);
                const jobName = jobMatch ? jobMatch[1].trim() : null;

                if (jobName) {
                    let foundMatchingOption = false;
                    let firstMatchingOption = null;

                    // Filter criteria options based on job
                    Array.from(criteriaSelect.options).forEach(option => {
                        if (option.value === '') return; // Skip "No specific criteria" option

                        // Check if this criteria is for the selected job
                        const isMatchingJob = option.text.includes(jobName);
                        option.style.display = isMatchingJob ? '' : 'none';

                        // Track first matching option for fallback
                        if (isMatchingJob && !firstMatchingOption && option.value !== '') {
                            firstMatchingOption = option;
                        }

                        // Check if this is the current/original criteria
                        if (option.value === originalCriteriaId && isMatchingJob) {
                            foundMatchingOption = true;
                        }
                    });

                    // Set selection based on matches
                    if (foundMatchingOption) {
                        // If original criteria matches job, keep it selected
                        criteriaSelect.value = originalCriteriaId;
                    } else if (firstMatchingOption) {
                        // If no match but we have valid options, select first one
                        criteriaSelect.value = firstMatchingOption.value;
                    } else {
                        // No valid options, select "No specific criteria"
                        criteriaSelect.value = '';
                    }

                    // After changing criteria, load the corresponding ratings
                    populateRatings(criteriaSelect.value || originalCriteriaId);
                }
            }

            // New function to preview smart analysis data (simulated update without saving)
            function previewSmartAnalysis() {
                const criteriaId = criteriaSelect.value || originalCriteriaId;
                const ratingId = ratingSelect.value;

                if (!criteriaId) return;

                // Show status to user
                const statusDiv = document.getElementById('smart-preview-status');
                statusDiv.textContent = 'Updating SMART analysis preview...';
                statusDiv.className = 'text-xs text-gray-600 mt-2';
                statusDiv.classList.remove('hidden');

                // Make AJAX request to preview SMART data
                fetch('/api/evaluations/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        evaluation_id: evaluasiId,
                        criteria_rating_id: ratingId,
                        preview_only: true // Flag to indicate this is just a preview
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        statusDiv.textContent = 'SMART analysis preview updated';
                        statusDiv.className = 'text-xs text-green-600 mt-2';

                        // Hide status after 3 seconds
                        setTimeout(() => {
                            statusDiv.textContent = '';
                            statusDiv.classList.add('hidden');
                        }, 3000);
                    } else {
                        statusDiv.textContent = 'Error updating preview: ' + data.message;
                        statusDiv.className = 'text-xs text-red-600 mt-2';
                    }
                })
                .catch(error => {
                    statusDiv.textContent = 'Error connecting to server';
                    statusDiv.className = 'text-xs text-red-600 mt-2';
                    console.error('Error updating preview:', error);
                });
            }

            // Preserve selection on form submission
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // If criteria is set to empty but we have an original value, use that
                if (criteriaSelect.value === '' && originalCriteriaId) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'criteria_id';
                    hiddenInput.value = originalCriteriaId;
                    form.appendChild(hiddenInput);
                }
            });

            // Initial filtering
            filterCriteria();

            // Filter when intern selection changes
            magangSelect.addEventListener('change', filterCriteria);

            // Load ratings when criterion selection changes
            criteriaSelect.addEventListener('change', function() {
                populateRatings(this.value || originalCriteriaId);
                previewSmartAnalysis(); // Preview SMART analysis when criteria changes
            });

            // Update SMART preview when rating changes
            ratingSelect.addEventListener('change', function() {
                previewSmartAnalysis();
            });

            // Preload all ratings on page load
            preloadAllRatings();
        });

        // Form validation function to ensure critical data is present
        function validateForm() {
            console.log('Validating form...');
            const form = document.getElementById('evaluationForm');
            const formData = new FormData(form);

            // Log form data for debugging
            console.log('Form data:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            // Make sure we have the required fields
            const magangId = formData.get('magang_id');
            const weekNum = formData.get('minggu_ke');
            const criteriaId = formData.get('criteria_id') || formData.get('original_criteria_id');

            if (!magangId || !weekNum) {
                alert('Please fill in all required fields');
                return false;
            }

            // Ensure criteria_id is explicitly included
            if (!formData.has('criteria_id') && "{{ $evaluasi->criteria_id }}") {
                // If no criteria_id in form but evaluation has one, add it
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'criteria_id';
                hiddenInput.value = "{{ $evaluasi->criteria_id }}";
                form.appendChild(hiddenInput);
                console.log('Added criteria_id:', "{{ $evaluasi->criteria_id }}");
            }

            return true;
        }
    </script>
</x-app-layout>