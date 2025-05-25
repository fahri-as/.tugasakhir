<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-edit text-indigo-600 mr-2"></i> {{ __('Edit Interview') }}
            </h2>
            <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('interview.update', $interview) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-id-card text-indigo-600 mr-2"></i> Basic Information
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">Applicant</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <select name="pelamar_id" id="pelamar_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            @foreach($pelamar as $p)
                                                <option value="{{ $p->pelamar_id }}" @selected($p->pelamar_id == $interview->pelamar_id)>
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
                                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Interviewer</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-tie text-gray-400"></i>
                                        </div>
                                        <select name="user_id" id="user_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            @php
                                                $hrUser = $users->firstWhere('role', 'hr');
                                                $defaultUserId = $hrUser ? $hrUser->user_id : null;
                                            @endphp
                                            @foreach($users as $user)
                                                <option value="{{ $user->user_id }}"
                                                    @selected(($user->role == 'hr' && !old('user_id')) || old('user_id') == $user->user_id || ($defaultUserId == $user->user_id))>
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

                        <!-- Interview Schedule -->
                        <div class="bg-gradient-to-r from-gray-50 to-indigo-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i> Interview Schedule
                            </h3>

                            <div class="transform transition duration-200 hover:-translate-y-1">
                                <label for="jadwal" class="block text-sm font-medium text-gray-700 mb-1">Schedule Date & Time</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-clock text-gray-400"></i>
                                    </div>
                                    <input type="datetime-local" name="jadwal" id="jadwal" value="{{ old('jadwal', $interview->jadwal->format('Y-m-d\TH:i')) }}" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                @error('jadwal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Evaluation Scores -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg border border-blue-100 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-star-half-alt text-purple-500 mr-2"></i> Evaluation Scores
                            </h3>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="qualifikasi_rating" class="block text-sm font-medium text-gray-700 mb-1">Qualification Rating</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-graduate text-gray-400"></i>
                                        </div>
                                        <select name="qualifikasi_rating" id="qualifikasi_rating" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">-- Select Rating --</option>
                                            @foreach($qualifikasiRatings as $rating)
                                                <option value="{{ $rating->id }}"
                                                    data-rating-level="{{ $rating->rating_level }}"
                                                    data-name="{{ $rating->name }}"
                                                    data-description="{{ $rating->description }}"
                                                    @selected($interview->kualifikasi_skor == $rating->rating_level)>
                                                    {{ $rating->name }} ({{ $rating->rating_level }}/5)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="kualifikasi_skor" id="kualifikasi_skor" value="{{ old('kualifikasi_skor', $interview->kualifikasi_skor) }}">
                                    @error('kualifikasi_skor')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <!-- Qualification Rating Scale Details -->
                                    <div class="mt-2 mb-3" id="qualification-rating-details" style="display: none;">
                                        <div class="bg-white p-3 rounded-lg border border-purple-200 shadow-sm">
                                            <h6 class="text-sm font-medium text-purple-700 mb-1 flex items-center">
                                                <i class="fas fa-info-circle mr-1"></i> <span id="qualification-rating-name">Rating Details</span>
                                            </h6>
                                            <div class="flex items-center mb-1">
                                                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full">Level <span id="qualification-rating-level">-</span>/5</span>
                                            </div>
                                            <div class="text-xs text-gray-700 mt-1">
                                                <p id="qualification-rating-description">Select a rating to see details.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="komunikasi_rating" class="block text-sm font-medium text-gray-700 mb-1">Communication Rating</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-comments text-gray-400"></i>
                                        </div>
                                        <select name="komunikasi_rating" id="komunikasi_rating" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">-- Select Rating --</option>
                                            @foreach($komunikasiRatings as $rating)
                                                <option value="{{ $rating->id }}"
                                                    data-rating-level="{{ $rating->rating_level }}"
                                                    data-name="{{ $rating->name }}"
                                                    data-description="{{ $rating->description }}"
                                                    @selected($interview->komunikasi_skor == $rating->rating_level)>
                                                    {{ $rating->name }} ({{ $rating->rating_level }}/5)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="komunikasi_skor" id="komunikasi_skor" value="{{ old('komunikasi_skor', $interview->komunikasi_skor) }}">
                                    @error('komunikasi_skor')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <!-- Communication Rating Scale Details -->
                                    <div class="mt-2 mb-3" id="communication-rating-details" style="display: none;">
                                        <div class="bg-white p-3 rounded-lg border border-purple-200 shadow-sm">
                                            <h6 class="text-sm font-medium text-purple-700 mb-1 flex items-center">
                                                <i class="fas fa-info-circle mr-1"></i> <span id="communication-rating-name">Rating Details</span>
                                            </h6>
                                            <div class="flex items-center mb-1">
                                                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full">Level <span id="communication-rating-level">-</span>/5</span>
                                            </div>
                                            <div class="text-xs text-gray-700 mt-1">
                                                <p id="communication-rating-description">Select a rating to see details.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="sikap_rating" class="block text-sm font-medium text-gray-700 mb-1">Attitude Rating</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-smile text-gray-400"></i>
                                        </div>
                                        <select name="sikap_rating" id="sikap_rating" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">-- Select Rating --</option>
                                            @foreach($sikapRatings as $rating)
                                                <option value="{{ $rating->id }}"
                                                    data-rating-level="{{ $rating->rating_level }}"
                                                    data-name="{{ $rating->name }}"
                                                    data-description="{{ $rating->description }}"
                                                    @selected($interview->sikap_skor == $rating->rating_level)>
                                                    {{ $rating->name }} ({{ $rating->rating_level }}/5)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="sikap_skor" id="sikap_skor" value="{{ old('sikap_skor', $interview->sikap_skor) }}">
                                    @error('sikap_skor')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <!-- Attitude Rating Scale Details -->
                                    <div class="mt-2 mb-3" id="attitude-rating-details" style="display: none;">
                                        <div class="bg-white p-3 rounded-lg border border-purple-200 shadow-sm">
                                            <h6 class="text-sm font-medium text-purple-700 mb-1 flex items-center">
                                                <i class="fas fa-info-circle mr-1"></i> <span id="attitude-rating-name">Rating Details</span>
                                            </h6>
                                            <div class="flex items-center mb-1">
                                                <span class="text-xs bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full">Level <span id="attitude-rating-level">-</span>/5</span>
                                            </div>
                                            <div class="text-xs text-gray-700 mt-1">
                                                <p id="attitude-rating-description">Select a rating to see details.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="bg-gradient-to-r from-gray-50 to-purple-50 p-3 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h5 class="text-sm font-medium text-gray-700 flex items-center">
                                            <i class="fas fa-calculator text-purple-500 mr-2"></i> Total Score
                                        </h5>
                                        <span class="text-lg font-bold text-purple-700" id="total-score-display">
                                            {{ number_format(($interview->kualifikasi_skor + $interview->komunikasi_skor + $interview->sikap_skor) / 3, 2) }}/5
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Interview Status -->
                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-lg border border-yellow-100 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-flag-checkered text-amber-500 mr-2"></i> Interview Status
                            </h3>

                            <div class="transform transition duration-200 hover:-translate-y-1">
                                <label for="status_seleksi" class="block text-sm font-medium text-gray-700 mb-1">Current Status</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tasks text-gray-400"></i>
                                    </div>
                                    <input type="text" value="{{ $interview->status_seleksi }}" class="pl-10 block w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" readonly>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Status cannot be changed directly. Use the action buttons on the interview details page.</p>
                            </div>
                        </div>

                        <!-- Hidden field for status_seleksi to maintain the current value -->
                        <input type="hidden" name="status_seleksi" value="{{ $interview->status_seleksi }}">

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-600 hover:to-indigo-700 active:bg-purple-800 focus:outline-none focus:border-purple-700 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-save mr-2"></i> Update Interview
                            </button>
                            <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
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
            const qualifikasiRating = document.getElementById('qualifikasi_rating');
            const komunikasiRating = document.getElementById('komunikasi_rating');
            const sikapRating = document.getElementById('sikap_rating');

            const qualifikasiScore = document.getElementById('kualifikasi_skor');
            const komunikasiScore = document.getElementById('komunikasi_skor');
            const sikapScore = document.getElementById('sikap_skor');

            const totalScoreDisplay = document.getElementById('total-score-display');

            // Rating details elements
            const qualificationDetails = document.getElementById('qualification-rating-details');
            const qualificationName = document.getElementById('qualification-rating-name');
            const qualificationLevel = document.getElementById('qualification-rating-level');
            const qualificationDescription = document.getElementById('qualification-rating-description');

            const communicationDetails = document.getElementById('communication-rating-details');
            const communicationName = document.getElementById('communication-rating-name');
            const communicationLevel = document.getElementById('communication-rating-level');
            const communicationDescription = document.getElementById('communication-rating-description');

            const attitudeDetails = document.getElementById('attitude-rating-details');
            const attitudeName = document.getElementById('attitude-rating-name');
            const attitudeLevel = document.getElementById('attitude-rating-level');
            const attitudeDescription = document.getElementById('attitude-rating-description');

            // Function to update scores based on rating selection
            function updateScoreFromRating(ratingSelect, scoreInput) {
                const selectedOption = ratingSelect.options[ratingSelect.selectedIndex];

                if (selectedOption && selectedOption.value) {
                    const ratingLevel = parseInt(selectedOption.dataset.ratingLevel);
                    scoreInput.value = ratingLevel;
                    updateTotalScore();
                }
            }

            // Function to update the total score display
            function updateTotalScore() {
                const kScore = parseInt(qualifikasiScore.value) || 0;
                const cScore = parseInt(komunikasiScore.value) || 0;
                const aScore = parseInt(sikapScore.value) || 0;

                const totalScore = (kScore + cScore + aScore) / 3;
                totalScoreDisplay.textContent = totalScore.toFixed(2) + '/5';
            }

            // Function to update rating details display
            function updateRatingDetails(ratingSelect, detailsElement, nameElement, levelElement, descriptionElement) {
                const selectedOption = ratingSelect.options[ratingSelect.selectedIndex];

                if (selectedOption && selectedOption.value) {
                    const ratingName = selectedOption.dataset.name;
                    const ratingLevel = selectedOption.dataset.ratingLevel;
                    const ratingDescription = selectedOption.dataset.description || 'No description available';

                    nameElement.textContent = ratingName;
                    levelElement.textContent = ratingLevel;
                    descriptionElement.textContent = ratingDescription;
                    detailsElement.style.display = 'block';
                } else {
                    detailsElement.style.display = 'none';
                }
            }

            // Add event listeners to rating selects
            qualifikasiRating.addEventListener('change', function() {
                updateScoreFromRating(this, qualifikasiScore);
                updateRatingDetails(this, qualificationDetails, qualificationName, qualificationLevel, qualificationDescription);
            });

            komunikasiRating.addEventListener('change', function() {
                updateScoreFromRating(this, komunikasiScore);
                updateRatingDetails(this, communicationDetails, communicationName, communicationLevel, communicationDescription);
            });

            sikapRating.addEventListener('change', function() {
                updateScoreFromRating(this, sikapScore);
                updateRatingDetails(this, attitudeDetails, attitudeName, attitudeLevel, attitudeDescription);
            });

            // Initialize rating details display if ratings are already selected
            if (qualifikasiRating.selectedIndex > 0) {
                updateRatingDetails(qualifikasiRating, qualificationDetails, qualificationName, qualificationLevel, qualificationDescription);
            }

            if (komunikasiRating.selectedIndex > 0) {
                updateRatingDetails(komunikasiRating, communicationDetails, communicationName, communicationLevel, communicationDescription);
            }

            if (sikapRating.selectedIndex > 0) {
                updateRatingDetails(sikapRating, attitudeDetails, attitudeName, attitudeLevel, attitudeDescription);
            }
        });
    </script>
</x-app-layout>
