<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-edit text-indigo-600 mr-2"></i> {{ __('Edit Weekly Evaluation') }}
            </h2>
            <a href="{{ route('evaluasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
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

                    <form id="evaluationForm" method="POST" action="{{ route('evaluasi.update', $evaluasi) }}">
                        @csrf
                        @method('PUT')

                        <!-- Editing Information -->
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 shadow-sm mb-6">
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
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-clipboard-list text-indigo-600 mr-2"></i> Evaluation Information
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="intern_id" class="block text-sm font-medium text-gray-700 mb-1">Intern</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-graduate text-gray-400"></i>
                                        </div>
                                        <select id="intern_id" name="magang_id" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                            @foreach($magangList as $intern)
                                                <option value="{{ $intern->magang_id }}" @selected($intern->magang_id == $evaluasi->magang_id)>
                                                    {{ $intern->pelamar->nama }} - {{ $intern->pelamar->job->nama_job }} ({{ $intern->pelamar->periode->nama_periode }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('magang_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="minggu_ke" class="block text-sm font-medium text-gray-700 mb-1">Week Number</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-week text-gray-400"></i>
                                        </div>
                                        <select id="minggu_ke" name="minggu_ke" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                            @for($i = 1; $i <= ($evaluasi->magang->pelamar->periode->durasi_minggu_magang ?? 8); $i++)
                                                <option value="{{ $i }}" @selected($i == $evaluasi->minggu_ke)>Week {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @error('minggu_ke')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Evaluation Criteria Section -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg border border-blue-100 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-star-half-alt text-purple-500 mr-2"></i> Evaluation Criteria
                            </h3>

                            <div class="space-y-6">
                                @php
                                    // Group all evaluations by criteria
                                    $evalsByCriteria = $allEvaluations->groupBy('criteria_id');
                                    $totalScore = 0;
                                    $criteriaCount = 0;
                                @endphp

                                @foreach($criteria as $criteriaItem)
                                    @php
                                        // Find the evaluation for this criteria if it exists
                                        $evaluation = $evalsByCriteria->get($criteriaItem->criteria_id, collect())->first();
                                        $ratingScales = $criteriaRatingScales->where('criteria_id', $criteriaItem->criteria_id);

                                        // Check if the evaluation belongs to this criteria
                                        $belongsToThisCriteria = $evaluation && $evaluation->criteria_id == $criteriaItem->criteria_id;
                                    @endphp

                                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="font-medium text-gray-900">{{ $criteriaItem->name }} ({{ $criteriaItem->code }})</h4>
                                            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-full">Weight: {{ $criteriaItem->weight }}</span>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-4">{{ $criteriaItem->description }}</p>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <i class="fas fa-star text-gray-400"></i>
                                                    </div>
                                                    <select name="ratings[{{ $criteriaItem->criteria_id }}]"
                                                            class="rating-dropdown pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                            data-criteria-id="{{ $criteriaItem->criteria_id }}"
                                                            onchange="showRatingDetails(this, '{{ $criteriaItem->criteria_id }}')">
                                                        <option value="">Not Rated Yet</option>
                                                        @foreach($ratingScales as $ratingScale)
                                                            <option value="{{ $ratingScale->id }}"
                                                                    data-rating-level="{{ $ratingScale->rating_level }}"
                                                                    data-name="{{ $ratingScale->name }}"
                                                                    data-description="{{ $ratingScale->description }}"
                                                                    @selected($belongsToThisCriteria && $evaluation->criteria_rating_id == $ratingScale->id)>
                                                                {{ $ratingScale->name }} ({{ $ratingScale->rating_level }}/5)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="rating-details-container" id="rating-details-{{ $criteriaItem->criteria_id }}"
                                                 style="{{ $belongsToThisCriteria && $evaluation->criteria_rating_id ? '' : 'display: none;' }}">
                                                <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                                    <h6 class="text-sm font-medium text-purple-700 mb-1 flex items-center">
                                                        <i class="fas fa-info-circle mr-1"></i>
                                                        <span id="rating-name-{{ $criteriaItem->criteria_id }}">
                                                            @if($belongsToThisCriteria && $evaluation->criteria_rating_id && $evaluation->criteriaRatingScale)
                                                                {{ $evaluation->criteriaRatingScale->name }}
                                                            @else
                                                                Rating Details
                                                            @endif
                                                        </span>
                                                    </h6>
                                                    <div class="flex items-center mb-1">
                                                        <span class="text-xs bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full">
                                                            Level
                                                            <span id="rating-level-{{ $criteriaItem->criteria_id }}">
                                                                @if($belongsToThisCriteria && $evaluation->criteria_rating_id && $evaluation->criteriaRatingScale)
                                                                    {{ $evaluation->criteriaRatingScale->rating_level }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </span>/5
                                                        </span>
                                                    </div>
                                                    <div class="text-xs text-gray-700 mt-1">
                                                        <p id="rating-description-{{ $criteriaItem->criteria_id }}">
                                                            @if($belongsToThisCriteria && $evaluation->criteria_rating_id && $evaluation->criteriaRatingScale)
                                                                {{ $evaluation->criteriaRatingScale->description }}
                                                            @else
                                                                Select a rating to see details.
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        if($belongsToThisCriteria && $evaluation->criteriaRatingScale) {
                                            $totalScore += $evaluation->criteriaRatingScale->rating_level;
                                            $criteriaCount++;
                                        }
                                    @endphp
                                @endforeach
                            </div>

                            <!-- Total Score Summary -->
                            <div class="mt-6">
                                <div class="bg-gradient-to-r from-gray-50 to-purple-50 p-4 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h5 class="text-md font-medium text-gray-700 flex items-center">
                                            <i class="fas fa-calculator text-purple-500 mr-2"></i> Total Score
                                        </h5>
                                        <span class="text-lg font-bold text-purple-700" id="total-score-display">
                                            @php
                                                $averageScore = $criteriaCount > 0 ? $totalScore / $criteriaCount : 0;
                                            @endphp
                                            {{ number_format($averageScore, 2) }}/5
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-600 hover:to-indigo-700 active:bg-purple-800 focus:outline-none focus:border-purple-700 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-save mr-2"></i> Update Evaluation
                            </button>
                            <a href="{{ route('evaluasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize rating dropdowns
            document.querySelectorAll('.rating-dropdown').forEach(dropdown => {
                // Check if a rating is already selected
                const criteriaId = dropdown.dataset.criteriaId;
                if (dropdown.value) {
                    showRatingDetails(dropdown, criteriaId);
                }
            });

            // Calculate total score whenever ratings change
            updateTotalScore();

            // Add event listener for week number change
            document.getElementById('minggu_ke').addEventListener('change', function() {
                const internId = document.getElementById('intern_id').value;
                const weekNumber = this.value;

                // Show loading indicator
                const criteriaSection = document.querySelector('.bg-gradient-to-r.from-blue-50.to-purple-50');
                criteriaSection.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin text-indigo-600 text-2xl"></i><p class="mt-2 text-gray-600">Loading evaluation data...</p></div>';

                // Fetch evaluation data for the selected intern and week
                fetch(`/api/evaluasi/get-data?magang_id=${internId}&minggu_ke=${weekNumber}`)
                    .then(response => response.json())
                    .then(data => {
                        // Reload the page with the new data
                        window.location.href = `/evaluasi/${data.evaluasi_id}/edit`;
                    })
                    .catch(error => {
                        console.error('Error fetching evaluation data:', error);
                        criteriaSection.innerHTML = '<div class="text-center py-4 text-red-600"><i class="fas fa-exclamation-circle mr-2"></i>Error loading evaluation data. Please try again.</div>';
                    });
            });
        });

        function showRatingDetails(dropdown, criteriaId) {
            const detailsContainer = document.getElementById(`rating-details-${criteriaId}`);
            const nameElement = document.getElementById(`rating-name-${criteriaId}`);
            const levelElement = document.getElementById(`rating-level-${criteriaId}`);
            const descriptionElement = document.getElementById(`rating-description-${criteriaId}`);

            if (dropdown.value) {
                // Get selected option
                const selectedOption = dropdown.options[dropdown.selectedIndex];

                // Update details with data from the selected option
                nameElement.textContent = selectedOption.dataset.name;
                levelElement.textContent = selectedOption.dataset.ratingLevel;
                descriptionElement.textContent = selectedOption.dataset.description || 'No description available';

                // Show the details container
                detailsContainer.style.display = 'block';
            } else {
                // Reset and hide if no option is selected
                nameElement.textContent = 'Rating Details';
                levelElement.textContent = '-';
                descriptionElement.textContent = 'Select a rating to see details.';
                detailsContainer.style.display = 'none';
            }

            // Update the total score
            updateTotalScore();
        }

        function updateTotalScore() {
            let totalScore = 0;
            let criteriaCount = 0;

            // Loop through all rating dropdowns
            document.querySelectorAll('.rating-dropdown').forEach(dropdown => {
                if (dropdown.value) {
                    const selectedOption = dropdown.options[dropdown.selectedIndex];
                    if (selectedOption.dataset.ratingLevel) {
                        totalScore += parseInt(selectedOption.dataset.ratingLevel);
                        criteriaCount++;
                    }
                }
            });

            // Calculate average score
            const averageScore = criteriaCount > 0 ? (totalScore / criteriaCount).toFixed(2) : '0.00';

            // Update the display
            document.getElementById('total-score-display').textContent = `${averageScore}/5`;
        }

        function validateForm() {
            // Check if at least one criteria is rated
            const hasRating = Array.from(document.querySelectorAll('.rating-dropdown')).some(dropdown => dropdown.value);

            if (!hasRating) {
                alert('Please rate at least one criteria before submitting.');
                return false;
            }

            return true;
        }
    </script>
</x-app-layout>
