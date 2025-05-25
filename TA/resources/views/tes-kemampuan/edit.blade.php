<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-edit text-purple-600 mr-2"></i> {{ __('Edit Skill Test') }}
            </h2>
            <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-id-card text-indigo-600 mr-2"></i> Basic Information
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="tes_id" class="block text-sm font-medium text-gray-700 mb-1">Test ID</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-hashtag text-gray-400"></i>
                                        </div>
                                        <input type="text" id="tes_id" value="{{ $tesKemampuan->tes_id }}" class="pl-10 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm focus:border-purple-500 focus:ring-purple-500" readonly>
                                    </div>
                                </div>

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">Applicant</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <select name="pelamar_id" id="pelamar_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                            @foreach($pelamar as $p)
                                                <option value="{{ $p->pelamar_id }}" @selected($p->pelamar_id == $tesKemampuan->pelamar_id)>
                                                    {{ $p->nama }} - {{ $p->job->nama_job }} ({{ $p->periode->nama_periode }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('pelamar_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Test Supervisor</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-tie text-gray-400"></i>
                                        </div>
                                        <select name="user_id" id="user_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                            @foreach($users as $user)
                                                <option value="{{ $user->user_id }}" @selected($user->user_id == $tesKemampuan->user_id)>
                                                    {{ $user->username }} @if($user->role == 'hr')(HR)@endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-gray-50 to-indigo-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i> Test Schedule
                            </h4>

                            <div class="transform transition duration-200 hover:-translate-y-1">
                                <label for="jadwal" class="block text-sm font-medium text-gray-700 mb-1">Schedule Date & Time</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-clock text-gray-400"></i>
                                    </div>
                                    <input type="datetime-local" name="jadwal" id="jadwal" value="{{ old('jadwal', $tesKemampuan->jadwal->format('Y-m-d\TH:i')) }}" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                                @error('jadwal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg border border-blue-100 shadow-sm mb-6">
                            <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-chart-line text-purple-500 mr-2"></i> Test Evaluation
                            </h4>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <!-- Hidden criteria input -->
                                <input type="hidden" name="criteria_id" id="criteria_id" value="{{ $tesKemampuan->criteria_id }}">

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="rating_scale" class="block text-sm font-medium text-gray-700 mb-1">Rating Scale</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-star text-gray-400"></i>
                                        </div>
                                        <select name="rating_scale" id="rating_scale" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                            <option value="">-- Select Rating Scale --</option>
                                            @foreach($ratingScales as $scale)
                                                <option value="{{ $scale->id }}"
                                                    data-min-score="{{ $scale->min_score }}"
                                                    data-max-score="{{ $scale->max_score }}"
                                                    data-rating-level="{{ $scale->rating_level }}"
                                                    data-name="{{ $scale->name }}"
                                                    @selected($currentRatingScale && $currentRatingScale->id == $scale->id)>
                                                    {{ $scale->name }} (Level {{ $scale->rating_level }}) - {{ $scale->min_score }}-{{ $scale->max_score }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Choose a rating scale that best represents the applicant's performance</p>
                                    @error('rating_scale')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="specific_score" class="block text-sm font-medium text-gray-700 mb-1">Specific Score</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calculator text-gray-400"></i>
                                        </div>
                                        <input type="number" name="specific_score" id="specific_score" value="{{ old('skor', $tesKemampuan->skor) }}" min="0" max="100" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 text-sm">/100</span>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500" id="score-range-info">Enter a score between the min and max of the selected rating scale</p>
                                    @error('specific_score')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Hidden score input that will be set based on the selected rating scale -->
                                <input type="hidden" name="skor" id="skor" value="{{ old('skor', $tesKemampuan->skor) }}">

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="status_seleksi" class="block text-sm font-medium text-gray-700 mb-1">Current Status</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-flag text-gray-400"></i>
                                        </div>
                                        <input type="text" value="{{ $tesKemampuan->status_seleksi }}" class="pl-10 block w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" readonly>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Status cannot be changed directly. Use the action buttons on the test details page.</p>
                                </div>

                                <!-- Hidden field for status_seleksi to maintain the current value -->
                                <input type="hidden" name="status_seleksi" value="{{ $tesKemampuan->status_seleksi }}">

                                <div class="sm:col-span-2 transform transition duration-200 hover:-translate-y-1">
                                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Test Notes</label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                            <i class="fas fa-sticky-note text-gray-400"></i>
                                        </div>
                                        <textarea name="catatan" id="catatan" rows="3" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('catatan', $tesKemampuan->catatan) }}</textarea>
                                    </div>
                                    @error('catatan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="bg-gradient-to-r from-gray-50 to-purple-50 p-3 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h5 class="text-sm font-medium text-gray-700 flex items-center">
                                            <i class="fas fa-calculator text-purple-500 mr-2"></i> Current Score
                                        </h5>
                                        <span class="text-lg font-bold text-purple-700" id="score-display">
                                            {{ $tesKemampuan->skor }}/100
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                            @php
                                                $scorePercentage = $tesKemampuan->skor;
                                                $scoreColor = 'bg-red-500';
                                                if ($scorePercentage >= 80) {
                                                    $scoreColor = 'bg-green-500';
                                                } elseif ($scorePercentage >= 60) {
                                                    $scoreColor = 'bg-blue-500';
                                                } elseif ($scorePercentage >= 40) {
                                                    $scoreColor = 'bg-yellow-500';
                                                }
                                            @endphp
                                            <div class="{{ $scoreColor }}" id="score-bar" style="width: {{ $scorePercentage }}%; height: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-lg border border-yellow-100 shadow-sm mb-6">
                            <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-info-circle text-amber-500 mr-2"></i> Test Information
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-3 rounded-md shadow-sm">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <p class="text-sm font-medium text-gray-500">Created</p>
                                    <p class="mt-1 text-sm text-gray-900 flex items-center">
                                        <i class="fas fa-calendar-plus text-gray-400 mr-1"></i>
                                        {{ $tesKemampuan->created_at->format('d M Y H:i:s') }}
                                    </p>
                                </div>
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <p class="text-sm font-medium text-gray-500">Last Updated</p>
                                    <p class="mt-1 text-sm text-gray-900 flex items-center">
                                        <i class="fas fa-clock text-gray-400 mr-1"></i>
                                        {{ $tesKemampuan->updated_at->format('d M Y H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-600 hover:to-indigo-700 active:bg-purple-800 focus:outline-none focus:border-purple-700 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-save mr-2"></i> Update Test
                            </button>
                            <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
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
            const pelamarSelect = document.getElementById('pelamar_id');
            const ratingScaleSelect = document.getElementById('rating_scale');
            const specificScoreInput = document.getElementById('specific_score');
            const scoreInput = document.getElementById('skor');
            const scoreDisplay = document.getElementById('score-display');
            const scoreBar = document.getElementById('score-bar');
            const scoreRangeInfo = document.getElementById('score-range-info');

            // Function to load rating scales based on the selected pelamar's job
            pelamarSelect.addEventListener('change', function() {
                const pelamarId = this.value;

                // Send an AJAX request to get criteria and rating scales for this pelamar's job
                fetch(`/tes-kemampuan/get-rating-scales-for-pelamar/${pelamarId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear current options
                        ratingScaleSelect.innerHTML = '<option value="">-- Select Rating Scale --</option>';

                        // Add new options
                        if (data.ratingScales && data.ratingScales.length > 0) {
                            data.ratingScales.forEach(scale => {
                                const option = document.createElement('option');
                                option.value = scale.id;
                                option.textContent = `${scale.name} (Level ${scale.rating_level}) - ${scale.min_score}-${scale.max_score}`;
                                option.dataset.minScore = scale.min_score;
                                option.dataset.maxScore = scale.max_score;
                                option.dataset.ratingLevel = scale.rating_level;
                                option.dataset.name = scale.name;
                                ratingScaleSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching rating scales for pelamar:', error));
            });

            // Function to update the score when rating scale changes
            ratingScaleSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (selectedOption && selectedOption.value) {
                    // Get the min and max scores for this rating scale
                    const minScore = parseInt(selectedOption.dataset.minScore);
                    const maxScore = parseInt(selectedOption.dataset.maxScore);
                    const scaleName = selectedOption.dataset.name;

                    // Update the score range info
                    scoreRangeInfo.textContent = `For "${scaleName}", enter a score between ${minScore} and ${maxScore}`;

                    // Set the min and max attributes of the specific score input
                    specificScoreInput.min = minScore;
                    specificScoreInput.max = maxScore;

                    // Set the specific score to the middle of the range as a suggestion
                    const avgScore = Math.round((minScore + maxScore) / 2);
                    specificScoreInput.value = avgScore;

                    // Update the hidden score input
                    scoreInput.value = avgScore;

                    // Update the score display
                    updateScoreDisplay(avgScore);
                }
            });

            // Function to update the score when the specific score input changes
            specificScoreInput.addEventListener('input', function() {
                const score = parseInt(this.value) || 0;

                // Update the hidden score input
                scoreInput.value = score;

                // Update the score display
                updateScoreDisplay(score);

                // Validate the score is within the selected rating scale range
                validateScoreRange();
            });

            // Function to validate the score is within the selected rating scale range
            function validateScoreRange() {
                const selectedOption = ratingScaleSelect.options[ratingScaleSelect.selectedIndex];

                if (selectedOption && selectedOption.value) {
                    const minScore = parseInt(selectedOption.dataset.minScore);
                    const maxScore = parseInt(selectedOption.dataset.maxScore);
                    const currentScore = parseInt(specificScoreInput.value);

                    if (currentScore < minScore || currentScore > maxScore) {
                        specificScoreInput.setCustomValidity(`Score must be between ${minScore} and ${maxScore} for the selected rating scale`);
                    } else {
                        specificScoreInput.setCustomValidity('');
                    }
                }
            }

            // Function to update the score display and progress bar
            function updateScoreDisplay(score) {
                // Update the score display
                scoreDisplay.textContent = `${score}/100`;

                // Update the score bar
                scoreBar.style.width = `${score}%`;

                // Update the score bar color
                if (score >= 80) {
                    scoreBar.className = 'bg-green-500';
                } else if (score >= 60) {
                    scoreBar.className = 'bg-blue-500';
                } else if (score >= 40) {
                    scoreBar.className = 'bg-yellow-500';
                } else {
                    scoreBar.className = 'bg-red-500';
                }
            }

            // Initialize the score range info if a rating scale is already selected
            if (ratingScaleSelect.selectedIndex > 0) {
                const selectedOption = ratingScaleSelect.options[ratingScaleSelect.selectedIndex];
                const minScore = parseInt(selectedOption.dataset.minScore);
                const maxScore = parseInt(selectedOption.dataset.maxScore);
                const scaleName = selectedOption.dataset.name;

                scoreRangeInfo.textContent = `For "${scaleName}", enter a score between ${minScore} and ${maxScore}`;
                specificScoreInput.min = minScore;
                specificScoreInput.max = maxScore;
            }
        });
    </script>

</x-app-layout>
