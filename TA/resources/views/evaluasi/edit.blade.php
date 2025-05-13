<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Weekly Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form id="evaluationForm" method="POST" action="{{ route('evaluasi.update', $evaluasi) }}" onsubmit="return validateForm()">
                        @csrf
                        @method('PUT')

                        <!-- Debug info - hidden but helpful for troubleshooting -->
                        <input type="hidden" name="debug_id" value="{{ $evaluasi->evaluasi_id }}">
                        <input type="hidden" name="debug_timestamp" value="{{ time() }}">

                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <!-- Magang (Intern) Selection -->
                            <div>
                                <label for="magang_id" class="block text-sm font-medium text-gray-700">Intern</label>
                                <select id="magang_id" name="magang_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('magang_id') border-red-500 @enderror" required>
                                    <option value="">Select Intern</option>
                                    @foreach($magang as $intern)
                                        <option value="{{ $intern->magang_id }}" @if(old('magang_id', $evaluasi->magang_id) == $intern->magang_id) selected @endif>
                                            {{ $intern->pelamar->nama }} - {{ $intern->pelamar->job->nama_job ?? 'No Job' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('magang_id')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Criteria Selection -->
                            <div>
                                <label for="criteria_id" class="block text-sm font-medium text-gray-700">Criteria (Optional)</label>
                                <select id="criteria_id" name="criteria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('criteria_id') border-red-500 @enderror">
                                    <option value="">No specific criteria</option>
                                    @foreach($criteria as $criteriaItem)
                                        <option value="{{ $criteriaItem->criteria_id }}"
                                                @if(old('criteria_id', $evaluasi->criteria_id) == $criteriaItem->criteria_id) selected @endif
                                                data-job-id="{{ $criteriaItem->job_id }}">
                                            {{ $criteriaItem->name }} ({{ $criteriaItem->code }}) - {{ $criteriaItem->job->nama_job }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Hidden input to preserve the original criteria_id if no new one is selected -->
                                <input type="hidden" name="original_criteria_id" value="{{ $evaluasi->criteria_id }}">

                                @error('criteria_id')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Current criteria: <strong>{{ $evaluasi->criteria->name ?? 'No specific criteria' }}</strong></p>
                            </div>

                            <!-- Rating Selection -->
                            <div>
                                <label for="rating_id" class="block text-sm font-medium text-gray-700">Rating</label>
                                <select id="rating_id" name="rating_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('rating_id') border-red-500 @enderror" required>
                                    <option value="">Select Rating</option>
                                    @foreach($ratingScales as $rating)
                                        <option value="{{ $rating->rating_id }}" @if(old('rating_id', $evaluasi->rating_id) == $rating->rating_id) selected @endif>
                                            {{ $rating->name }} ({{ $rating->singkatan }}) - Value: {{ $rating->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rating_id')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Week Number -->
                            <div>
                                <label for="minggu_ke" class="block text-sm font-medium text-gray-700">Week Number</label>
                                <input type="number" id="minggu_ke" name="minggu_ke" min="1" value="{{ old('minggu_ke', $evaluasi->minggu_ke) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('minggu_ke') border-red-500 @enderror" required>
                                @error('minggu_ke')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex items-center space-x-3">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update Evaluation
                            </button>
                            <a href="{{ route('evaluasi.show', $evaluasi) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <form action="{{ route('evaluasi.destroy', $evaluasi) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this evaluation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete
                                </button>
                            </form>
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
            const originalCriteriaId = "{{ $evaluasi->criteria_id }}";

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
                }
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
            const ratingId = formData.get('rating_id');
            const weekNum = formData.get('minggu_ke');
            const criteriaId = formData.get('criteria_id') || formData.get('original_criteria_id');

            if (!magangId || !ratingId || !weekNum) {
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


