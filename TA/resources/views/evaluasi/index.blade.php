<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Weekly Evaluations') }}
            </h2>
            <a href="{{ route('evaluasi.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create New Evaluation
            </a>
        </div>
    </x-slot>

    <!-- CSRF Token for AJAX Requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Period Filter -->
                    <div class="mb-6">
                        <form action="{{ route('evaluasi.index') }}" method="GET" class="flex flex-wrap items-end space-x-4">
                            <div class="flex-grow">
                                <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Period</label>
                                <select id="periode_filter" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach($periods as $period)
                                        <option value="{{ $period->periode_id }}" {{ $selectedPeriodeId == $period->periode_id ? 'selected' : '' }}>
                                            {{ $period->nama_periode }} ({{ $period->tanggal_mulai->format('d M Y') }} - {{ $period->tanggal_selesai->format('d M Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Filter
                                </button>

                                @if(request()->has('periode_id'))
                                    <a href="{{ route('evaluasi.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- SMART Dashboard Links -->
                    <div class="bg-white shadow rounded-lg p-4 mb-6">
                        <h2 class="text-lg font-medium mb-3">SMART Weekly Evaluation Dashboards</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('test.evaluasi.dashboard', ['job_id' => 'JOB001']) }}" class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition duration-150">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Cook Position Dashboard</h3>
                                    <p class="text-sm text-gray-500">View SMART analysis for Cook position</p>
                                </div>
                            </a>

                            <a href="{{ route('test.evaluasi.dashboard', ['job_id' => 'JOB004']) }}" class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition duration-150">
                                <div class="bg-pink-100 p-3 rounded-full mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Pastry Chef Dashboard</h3>
                                    <p class="text-sm text-gray-500">View SMART analysis for Pastry Chef position</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Weekly Evaluation Status Overview -->
                    @if($weekCount > 0)
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Evaluation Status Overview</h3>
                            <button id="toggle-evaluation-status" class="inline-flex items-center px-3 py-1.5 bg-indigo-100 border border-indigo-300 rounded-md text-xs text-indigo-700 uppercase tracking-widest hover:bg-indigo-200 transition duration-150">
                                <svg id="chevron-down" class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                                <svg id="chevron-up" class="w-4 h-4 mr-1 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                </svg>
                                <span id="status-toggle-text">Hide Overview</span>
                            </button>
                        </div>
                        <div id="weekly-evaluation-status" class="bg-white shadow rounded-lg mb-6 overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Position</th>
                                            @for($week = 1; $week <= $weekCount; $week++)
                                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Week {{ $week }}</th>
                                            @endfor
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($allInterns as $intern)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $intern->pelamar->nama }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $intern->pelamar->job->nama_job ?? 'N/A' }}
                                                </td>
                                                @for($week = 1; $week <= $weekCount; $week++)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                    @php
                                                // Get all evaluations for this intern for this week
                                                $internEvaluations = [];
                                                if (isset($evaluationsByWeek[$week][$intern->magang_id])) {
                                                    $internEvaluations = $evaluationsByWeek[$week][$intern->magang_id];
                                                }

                                                // Check how many criteria have ratings
                                                $totalCriteria = count($internEvaluations);
                                                $ratedCriteria = 0;

                                                foreach ($internEvaluations as $eval) {
                                                    if (!empty($eval->criteria_rating_id)) {
                                                        $ratedCriteria++;
                                                    }
                                                }

                                                // Determine status based on rated criteria
                                                $isFullyEvaluated = $totalCriteria > 0 && $ratedCriteria == $totalCriteria;
                                                $isPartiallyEvaluated = $totalCriteria > 0 && $ratedCriteria > 0 && $ratedCriteria < $totalCriteria;
                                                $isNotEvaluated = $totalCriteria == 0 || $ratedCriteria == 0;
                                            @endphp

                                                        @if($isFullyEvaluated)
                                                            <span data-status-card data-magang-id="{{ $intern->magang_id }}" data-week="{{ $week }}" class="inline-flex flex-col items-center cursor-pointer" onclick="loadWeekEvaluations('{{ $selectedPeriodeId }}', {{ $week }}); setTimeout(() => showInternEvaluations('{{ $intern->magang_id }}', '{{ $intern->pelamar->nama }}', '{{ $intern->pelamar->job->job_id ?? 'unknown' }}'), 500);">
                                                                <span data-status class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Completed</span>
                                                                <span class="mt-1 text-xs">
                                                                    <span data-counter>{{ $ratedCriteria }}/{{ $totalCriteria }}</span> criteria
                                                                </span>
                                                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                                                    <div class="progress-value bg-green-600 h-1.5 rounded-full" style="width: 100%"></div>
                                                                </div>
                                                            </span>
                                                        @elseif($isPartiallyEvaluated)
                                                            <span data-status-card data-magang-id="{{ $intern->magang_id }}" data-week="{{ $week }}" class="inline-flex flex-col items-center cursor-pointer" onclick="loadWeekEvaluations('{{ $selectedPeriodeId }}', {{ $week }}); setTimeout(() => showInternEvaluations('{{ $intern->magang_id }}', '{{ $intern->pelamar->nama }}', '{{ $intern->pelamar->job->job_id ?? 'unknown' }}'), 500);">
                                                                <span data-status class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">In Progress</span>
                                                                <span class="mt-1 text-xs">
                                                                    <span data-counter>{{ $ratedCriteria }}/{{ $totalCriteria }}</span> criteria
                                                                </span>
                                                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                                                    <div class="progress-value bg-yellow-600 h-1.5 rounded-full" style="width: {{ ($ratedCriteria / $totalCriteria) * 100 }}%"></div>
                                                                </div>
                                                            </span>
                                                        @else
                                                            <span data-status-card data-magang-id="{{ $intern->magang_id }}" data-week="{{ $week }}" class="inline-flex flex-col items-center cursor-pointer" onclick="currentPeriod = '{{ $selectedPeriodeId }}'; currentWeek = {{ $week }}; handleNotEvaluated(currentPeriod, currentWeek, '{{ $intern->magang_id }}', '{{ $intern->pelamar->nama }}', '{{ $intern->pelamar->job->job_id ?? 'unknown' }}');">
                                                                <span data-status class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">Not Started</span>
                                                                <span class="mt-1 text-xs">
                                                                    <span data-counter>0/{{ $totalCriteria }}</span> criteria
                                                                </span>
                                                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                                                    <div class="progress-value bg-gray-400 h-1.5 rounded-full" style="width: 0%"></div>
                                                                </div>
                                                            </span>
                                                        @endif
                                                    </td>
                                                @endfor
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                    <button class="text-blue-600 hover:text-blue-900" onclick="loadInternWeekSummary('{{ $intern->magang_id }}', '{{ $intern->pelamar->nama }}')">
                                                        View All Weeks
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Week Selection Cards -->
                        <div id="week-cards" class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-6">
                            @for($week = 1; $week <= $weekCount; $week++)
                                <div class="bg-white shadow rounded-lg border border-gray-200 hover:shadow-md transition-shadow cursor-pointer overflow-hidden"
                                    onclick="console.log('Week card clicked: {{ $week }}', '{{ $selectedPeriodeId }}'); loadWeekEvaluations('{{ $selectedPeriodeId }}', {{ $week }});">
                                    <div class="p-4">
                                        <h3 class="text-lg font-medium text-gray-900">Week {{ $week }}</h3>
                                        <p class="mt-2 text-sm text-gray-600">
                                                                                            @php
                                                // Count interns with evaluations for this week
                                                $evaluatedCount = 0;
                                                $partialCount = 0;
                                                $totalCount = $allInterns->count();

                                                if (isset($evaluationsByWeek[$week])) {
                                                    foreach ($evaluationsByWeek[$week] as $magangId => $evals) {
                                                        // Count total criteria and how many are rated
                                                        $totalCriteria = count($evals);
                                                        $ratedCriteria = 0;

                                                        foreach ($evals as $eval) {
                                                            if (!empty($eval->criteria_rating_id)) {
                                                                $ratedCriteria++;
                                                            }
                                                        }

                                                        // Determine status based on criteria ratings
                                                        if ($totalCriteria > 0 && $ratedCriteria == $totalCriteria) {
                                                            // Fully evaluated - all criteria have ratings
                                                            $evaluatedCount++;
                                                        } elseif ($totalCriteria > 0 && $ratedCriteria > 0) {
                                                            // Partially evaluated - some criteria have ratings, but not all
                                                            $partialCount++;
                                                        }
                                                        // If $ratedCriteria is 0, it's counted in pendingCount
                                                    }
                                                }

                                                $pendingCount = $totalCount - $evaluatedCount - $partialCount;
                                            @endphp
                                            <span class="font-medium text-green-700">{{ $evaluatedCount }}</span> fully evaluated
                                            @if($partialCount > 0)
                                                · <span class="font-medium text-yellow-700">{{ $partialCount }}</span> partially evaluated
                                            @endif
                                            @if($pendingCount > 0)
                                                · <span class="font-medium text-red-700">{{ $pendingCount }}</span> not evaluated
                                            @endif
                                        </p>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-2 border-t">
                                        <span class="text-xs text-indigo-600 font-medium">Click to view details</span>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        No weeks defined for this period. Please select a different period or update the week duration in period settings.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Evaluation Data Table (initially hidden, shown when a week is selected) -->
                    <div id="evaluation-table-container" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 id="week-title" class="text-lg font-medium text-gray-900">Week # Evaluations</h3>
                            <button onclick="showWeekCards()" class="inline-flex items-center px-3 py-1.5 bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition duration-150">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Weeks
                            </button>
                        </div>

                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table id="interns-table" class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern Name</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SMART Score</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="interns-tbody" class="bg-white divide-y divide-gray-200">
                                        <!-- Intern data will be loaded here via AJAX -->
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                Select a week to view evaluations
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="no-interns" class="hidden bg-white shadow rounded-lg text-center py-8 mt-4">
                            <p class="text-gray-500">No interns evaluated for this week yet.</p>
                            <a href="{{ route('evaluasi.create') }}?periode_id={{ $selectedPeriodeId }}&week=" id="create-link" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Add Evaluation for Week #
                            </a>
                        </div>
                    </div>

                    <!-- Criteria Evaluations for Selected Intern (hidden by default) -->
                    <div id="criteria-container" class="hidden mt-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 id="intern-title" class="text-lg font-medium text-gray-900">Evaluations for [Intern Name]</h3>
                            <button onclick="showInternsTable()" class="inline-flex items-center px-3 py-1.5 bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 transition duration-150">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Interns List
                            </button>
                        </div>

                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table id="criteria-table" class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="criteria-tbody" class="bg-white divide-y divide-gray-200">
                                        <!-- Criteria evaluations will be loaded here -->
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 font-medium">Total Score</td>
                                            <td></td>
                                            <td id="total-score" class="px-6 py-4 font-medium">0.00</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- SMART Analysis (if Cook or Pastry Chef) -->
                        <div id="smart-analysis" class="hidden mt-4 bg-white shadow rounded-lg overflow-hidden">
                            <div class="bg-indigo-50 px-6 py-4 border-b">
                                <h3 class="font-semibold text-indigo-900">SMART Analysis</h3>
                                <p class="text-xs text-indigo-700">This analysis is only available for Cook and Pastry Chef positions</p>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <h4 class="text-md font-medium mb-2">Normalized Scores (0-1 scale)</h4>
                                        <div id="normalized-scores" class="bg-gray-50 p-4 rounded">
                                            <!-- Will be populated via JS -->
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-md font-medium mb-2">Weighted Contribution</h4>
                                        <div id="weighted-scores" class="bg-gray-50 p-4 rounded">
                                            <!-- Will be populated via JS -->
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for handling the evaluations display -->
    <script>
        let currentWeek = 0;
        let currentPeriod = '';
        let currentMagangId = '';
        let weeklyEvaluations = [];
        let smartResults = {};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Pre-loaded scores from PHP
        const preloadedScores = {
            @foreach($totalScores as $magangId => $weeks)
                '{{ $magangId }}': {
                    @foreach($weeks as $weekNum => $scoreData)
                        '{{ $weekNum }}': {{
                            is_object($scoreData) ?
                            floatval($scoreData->total_skor) :
                            floatval($scoreData)
                        }},
                    @endforeach
                },
            @endforeach
        };

        // Store all ratings by criteria ID
        const allRatings = {};

                // Function to preload all ratings for all criteria in the system
                async function preloadAllRatings() {
            try {
                console.log('Starting preloadAllRatings');

                // If we have criteria in the page already, let's add them to our list
                const criteriaElements = document.querySelectorAll('[data-criteria-id]');
                const criteriaIds = new Set();

                criteriaElements.forEach(el => {
                    const criteriaId = el.dataset.criteriaId;
                    if (criteriaId) {
                        criteriaIds.add(criteriaId);
                    }
                });

                // Also add any criteria from weeklyEvaluations
                if (Array.isArray(weeklyEvaluations)) {
                    weeklyEvaluations.forEach(eval => {
                        if (eval && eval.criteria_id) {
                            criteriaIds.add(eval.criteria_id);
                        }
                    });
                }

                // Extract criteria IDs from any existing rows in the table
                document.querySelectorAll('#criteria-tbody tr').forEach(row => {
                    const ratingElement = row.querySelector('.rating-dropdown');
                    if (ratingElement && ratingElement.dataset.criteriaId) {
                        criteriaIds.add(ratingElement.dataset.criteriaId);
                    }
                });

                // Extract criteria IDs from any existing table cells
                const criteriaTexts = Array.from(document.querySelectorAll('td')).map(td => td.textContent);
                const criteriaRegex = /\(K\d+\)/g;
                criteriaTexts.forEach(text => {
                    if (text) {
                        const matches = text.match(criteriaRegex);
                        if (matches) {
                            matches.forEach(match => {
                                // Extract the code (e.g., K1, K2) from the match
                                const code = match.replace(/[()]/g, '');
                                // If we find K1, K2, etc. add them to the set
                                criteriaIds.add(code);
                            });
                        }
                    }
                });

                // Add some common criteria ID patterns as fallback
                for (let i = 1; i <= 10; i++) {
                    criteriaIds.add(`K${i}`);
                }

                // If no criteria, log but continue as we'll fetch on demand later
                if (criteriaIds.size === 0) {
                    console.log('No criteria IDs found to preload - will fetch on demand');
                } else {
                    console.log(`Found ${criteriaIds.size} unique criteria IDs to preload`);

                    // For each criteria, fetch ratings
                    const fetchPromises = Array.from(criteriaIds).map(criteriaId =>
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
                                console.log(`Loaded ${data.ratings.length} ratings for criteria ${criteriaId}`);
                            }
                        })
                        .catch(error => {
                            console.error(`Error loading ratings for criteria ${criteriaId}:`, error);
                        })
                    );

                    // Wait for all fetches to complete
                    await Promise.all(fetchPromises);
                    console.log('All ratings preloaded successfully');
                }
            } catch (error) {
                console.error('Error in preloadAllRatings:', error);
            }
        }

        // Define all necessary functions first
        function loadWeekEvaluations(periodeId, week) {
            console.log('loadWeekEvaluations called with period:', periodeId, 'week:', week);
            try {
                currentWeek = week;
                currentPeriod = periodeId;

                // Update the week title and create link
                const weekTitle = document.getElementById('week-title');
                if (weekTitle) {
                    weekTitle.textContent = `Week ${week} Evaluations`;
                }

                const createLink = document.getElementById('create-link');
                if (createLink) {
                    createLink.href = `{{ route('evaluasi.create') }}?periode_id=${periodeId}&week=${week}`;
                    createLink.textContent = `Add Evaluation for Week ${week}`;
                }

                // Hide week cards and show evaluation table
                const weekCards = document.getElementById('week-cards');
                const evaluationTable = document.getElementById('evaluation-table-container');
                const criteriaContainer = document.getElementById('criteria-container');

                if (weekCards) weekCards.classList.add('hidden');
                if (evaluationTable) evaluationTable.classList.remove('hidden');
                if (criteriaContainer) criteriaContainer.classList.add('hidden');
            } catch (error) {
                console.error('Error in loadWeekEvaluations:', error);
            }

            // Hide the intern summary if it exists
            const summaryContainer = document.getElementById('intern-week-summary');
            if (summaryContainer) {
                summaryContainer.classList.add('hidden');
            }

            // Show loading indicator
            const tbody = document.getElementById('interns-tbody');
            if (tbody) {
                tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center">Loading...</td></tr>';
            }

            // Fetch data for the selected week
            fetchWeekData(periodeId, week);
        }

        // Add event listener when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Set up the toggle functionality for the evaluation status overview
            const toggleButton = document.getElementById('toggle-evaluation-status');
            const statusTable = document.getElementById('weekly-evaluation-status');
            const chevronDown = document.getElementById('chevron-down');
            const chevronUp = document.getElementById('chevron-up');
            const toggleText = document.getElementById('status-toggle-text');

            // Initialize the currentPeriod variable from the selected period
            currentPeriod = '{{ $selectedPeriodeId }}';

            // Make sure the overview is visible by default
            statusTable.classList.remove('hidden');
            chevronDown.classList.remove('hidden');
            chevronUp.classList.add('hidden');
            toggleText.textContent = 'Hide Overview';

            toggleButton.addEventListener('click', function() {
                if (statusTable.classList.contains('hidden')) {
                    statusTable.classList.remove('hidden');
                    chevronDown.classList.remove('hidden');
                    chevronUp.classList.add('hidden');
                    toggleText.textContent = 'Hide Overview';
                } else {
                    statusTable.classList.add('hidden');
                    chevronDown.classList.add('hidden');
                    chevronUp.classList.remove('hidden');
                    toggleText.textContent = 'Show Overview';
                }
            });
        });

        function showWeekCards() {
            document.getElementById('week-cards').classList.remove('hidden');
            document.getElementById('evaluation-table-container').classList.add('hidden');
            document.getElementById('criteria-container').classList.add('hidden');
            currentWeek = 0;
            currentMagangId = '';
        }

        function showInternsTable() {
            document.getElementById('evaluation-table-container').classList.remove('hidden');
            document.getElementById('criteria-container').classList.add('hidden');
            currentMagangId = '';
        }

        function loadInternWeekSummary(magangId, internName) {
            // This function loads the summary view for all weeks for a specific intern
            // Make sure we have a period ID
            if (!currentPeriod) {
                alert('No period selected. Please select a period first.');
                return;
            }

            // Hide week cards and criteria container
            document.getElementById('week-cards').classList.add('hidden');
            document.getElementById('evaluation-table-container').classList.add('hidden');
            document.getElementById('criteria-container').classList.add('hidden');

            // Create or show the intern summary container
            let summaryContainer = document.getElementById('intern-week-summary');
            if (!summaryContainer) {
                summaryContainer = document.createElement('div');
                summaryContainer.id = 'intern-week-summary';
                summaryContainer.className = 'bg-white shadow rounded-lg mb-6 overflow-hidden';
                document.querySelector('.max-w-7xl .bg-white.overflow-hidden.shadow-sm .p-6').appendChild(summaryContainer);
            } else {
                summaryContainer.classList.remove('hidden');
            }

            // Set the loading state
            summaryContainer.innerHTML = `
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Weekly Evaluations for ${internName}</h3>
                    <button onclick="hideInternSummary()" class="inline-flex items-center px-3 py-1.5 bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Close
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-center">
                        <svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="ml-2 text-gray-600">Loading evaluations...</span>
                    </div>
                </div>
            `;

            // Fetch data for all weeks for this intern
            fetch(`{{ route('api.evaluations') }}?periode_id=${currentPeriod}&magang_id=${magangId}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Process the data and update the UI
                populateInternSummary(summaryContainer, data.evaluations, internName, magangId);
            })
            .catch(error => {
                console.error('Error fetching evaluations:', error);
                summaryContainer.innerHTML = `
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Weekly Evaluations for ${internName}</h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-red-50 border-l-4 border-red-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        Error loading evaluations: ${error.message}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        function hideInternSummary() {
            const summaryContainer = document.getElementById('intern-week-summary');
            if (summaryContainer) {
                summaryContainer.classList.add('hidden');
            }
            showWeekCards();
        }

        function populateInternSummary(container, evaluations, internName, magangId) {
            // Group evaluations by week
            const evaluationsByWeek = {};
            evaluations.forEach(eval => {
                const week = eval.minggu_ke;
                if (!evaluationsByWeek[week]) {
                    evaluationsByWeek[week] = [];
                }
                evaluationsByWeek[week].push(eval);
            });

            // Build the HTML for the summary
            let weeksHtml = '';

            // Sort weeks numerically
            const weeks = Object.keys(evaluationsByWeek).sort((a, b) => parseInt(a) - parseInt(b));

            if (weeks.length === 0) {
                weeksHtml = `
                    <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    No evaluations found for this intern.
                                </p>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                // Build accordion for each week
                weeks.forEach(week => {
                                        const weekEvals = evaluationsByWeek[week];
                    const totalScore = weekEvals[0].total_score || 0;
                    const hasScore = parseFloat(totalScore) > 0;

                    weeksHtml += `
                        <div class="border rounded-lg mb-4 overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 flex justify-between items-center cursor-pointer"
                                 onclick="toggleWeekDetails('week-${week}-${magangId}')">
                                <h4 class="font-medium">Week ${week}</h4>
                                <div class="flex items-center">
                                    <span class="mr-3 font-medium ${hasScore ? 'text-green-600' : 'text-yellow-600'}">
                                        Score: ${parseFloat(totalScore).toFixed(2)}
                                        ${!hasScore ? '<span class="text-xs font-normal">(Partially Evaluated)</span>' : ''}
                                    </span>
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div id="week-${week}-${magangId}" class="hidden border-t">
                                <div class="p-4">
                                    <h5 class="font-medium mb-2">Criteria Evaluations</h5>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                    `;

                    // Add rows for each criteria
                    weekEvals.forEach(eval => {
                        const criteriaName = eval.criteria ? eval.criteria.nama_criteria : 'Unknown Criteria';
                        const ratingName = eval.criteriaRatingScale ? eval.criteriaRatingScale.rating_name : 'Not rated';
                        const ratingLevel = eval.criteriaRatingScale ? eval.criteriaRatingScale.rating_level : 0;
                        const contributes = ratingLevel > 0;
                        const editUrl = '{{ url("evaluasi") }}/' + eval.evaluasi_id + '/edit';

                        weeksHtml += `
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">${criteriaName}</td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm ${contributes ? 'text-gray-900' : 'text-yellow-600'}">
                                    ${ratingName}
                                    ${contributes ? '' : ' <span class="text-xs text-yellow-700">(Rating does not contribute to score)</span>'}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm text-right">
                                    <a href="${editUrl}" class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        `;
                    });

                    weeksHtml += `
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            // Update the container with the summary
            container.innerHTML = `
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Weekly Evaluations for ${internName}</h3>
                    <button onclick="hideInternSummary()" class="inline-flex items-center px-3 py-1.5 bg-gray-200 border border-gray-300 rounded-md text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Close
                    </button>
                </div>
                <div class="p-6">
                    ${weeksHtml}
                </div>
            `;
        }

        function toggleWeekDetails(weekId) {
            const weekDetails = document.getElementById(weekId);
            if (weekDetails.classList.contains('hidden')) {
                weekDetails.classList.remove('hidden');
            } else {
                weekDetails.classList.add('hidden');
            }
        }

        function fetchWeekData(periodeId, week) {
            console.log('Fetching week data for period:', periodeId, 'week:', week);
            try {
                // Make an AJAX request to get the evaluations for this week
                fetch(`{{ route('api.evaluations') }}?periode_id=${periodeId}&week=${week}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Store the full evaluations data
                    weeklyEvaluations = data.evaluations;
                    smartResults = data.smart_results || {};

                    // Group evaluations by intern
                    const internMap = new Map();

                    weeklyEvaluations.forEach(eval => {
                        if (!eval.magang || !eval.magang.pelamar) return;

                        const magangId = eval.magang_id;

                        if (!internMap.has(magangId)) {
                            internMap.set(magangId, {
                                magangId: magangId,
                                nama: eval.magang.pelamar.nama,
                                job: eval.magang.pelamar.job ? eval.magang.pelamar.job.nama_job : 'N/A',
                                jobId: eval.magang.pelamar.job ? eval.magang.pelamar.job.job_id : null,
                                evaluations: [],
                                totalScore: 0,
                                count: 0
                            });
                        }

                        const intern = internMap.get(magangId);
                        intern.evaluations.push(eval);
                        intern.totalScore += parseFloat(eval.skor_minggu);
                        intern.count++;
                    });

                    // Calculate average scores
                    internMap.forEach(intern => {
                        intern.averageScore = intern.count > 0 ? (intern.totalScore / intern.count).toFixed(2) : 0;
                    });

                    // Convert to array for rendering
                    const interns = Array.from(internMap.values());
                    populateInternsTable(interns);
                })
                .catch(error => {
                    console.error('Error fetching evaluations:', error);
                    const tbody = document.getElementById('interns-tbody');
                    if (tbody) {
                        tbody.innerHTML = `<tr><td colspan="4" class="px-6 py-4 text-center text-red-600">Error loading evaluations: ${error.message}</td></tr>`;
                    }
                });
            } catch(error) {
                console.error('Error in fetchWeekData:', error);
                const tbody = document.getElementById('interns-tbody');
                if (tbody) {
                    tbody.innerHTML = `<tr><td colspan="4" class="px-6 py-4 text-center text-red-600">Internal error: ${error.message}</td></tr>`;
                }
            }
        }

        function populateInternsTable(interns) {
            const tbody = document.getElementById('interns-tbody');
            tbody.innerHTML = ''; // Clear existing rows

            if (!interns || interns.length === 0) {
                // Show no interns message
                document.getElementById('no-interns').classList.remove('hidden');
                document.getElementById('interns-table').classList.add('hidden');
            } else {
                // Hide no interns message and show table
                document.getElementById('no-interns').classList.add('hidden');
                document.getElementById('interns-table').classList.remove('hidden');

                // Populate table with intern data
                interns.forEach(intern => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-gray-50 cursor-pointer';
                    row.onclick = () => showInternEvaluations(intern.magangId, intern.nama, intern.jobId);

                    // Count total criteria and how many have ratings for this intern
                    const totalCriteria = intern.evaluations.length;
                    let ratedCriteria = 0;

                    intern.evaluations.forEach(eval => {
                        if (eval.criteria_rating_id) {
                            ratedCriteria++;
                        }
                    });

                    // Determine status based on rated criteria
                    const isFullyEvaluated = totalCriteria > 0 && ratedCriteria === totalCriteria;
                    const isPartiallyEvaluated = totalCriteria > 0 && ratedCriteria > 0 && ratedCriteria < totalCriteria;
                    const isNotEvaluated = totalCriteria === 0 || ratedCriteria === 0;

                    // Get total score for display
                    let scoreValue = '0.00';
                    if (preloadedScores && preloadedScores[intern.magangId] && preloadedScores[intern.magangId][currentWeek]) {
                        scoreValue = parseFloat(preloadedScores[intern.magangId][currentWeek]).toFixed(2);
                    } else if (intern.evaluations.length > 0) {
                        const evalWithScore = intern.evaluations.find(e => e.hasOwnProperty('total_score'));
                        if (evalWithScore && evalWithScore.total_score) {
                            scoreValue = parseFloat(evalWithScore.total_score).toFixed(2);
                        }
                    }

                    // Format the score display
                    let scoreDisplay = '';
                    if (isFullyEvaluated) {
                        scoreDisplay = `
                            <span class="font-medium text-indigo-700">${scoreValue}</span>
                            <button onclick="showInternEvaluations('${intern.magangId}', '${intern.nama}', '${intern.jobId}'); event.stopPropagation();" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200 transition-colors">
                                Fully Evaluated
                            </button>
                        `;
                    } else if (isPartiallyEvaluated) {
                        scoreDisplay = `
                            <span class="text-yellow-600">${scoreValue}</span>
                            <button onclick="showInternEvaluations('${intern.magangId}', '${intern.nama}', '${intern.jobId}'); event.stopPropagation();" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 hover:bg-yellow-200 transition-colors">
                                Partially Evaluated
                            </button>
                        `;
                    } else {
                        scoreDisplay = `
                            <span class="text-gray-500">0.00</span>
                            <button onclick="handleNotEvaluated(currentPeriod, currentWeek, '${intern.magangId}', '${intern.nama}', '${intern.jobId}'); event.stopPropagation();" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 hover:bg-red-200 transition-colors">
                                Not Evaluated
                            </button>
                        `;
                    }

                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${intern.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${intern.job}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${scoreDisplay}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="showInternEvaluations('${intern.magangId}', '${intern.nama}', '${intern.jobId}'); event.stopPropagation();" class="text-blue-600 hover:text-blue-900 mr-3">View Details</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        }

        function showInternEvaluations(magangId, internName, jobId) {
            currentMagangId = magangId;

            // Update the intern title
            document.getElementById('intern-title').textContent = `Evaluations for ${internName} - Week ${currentWeek}`;

            // Hide interns table and show criteria table
            document.getElementById('evaluation-table-container').classList.add('hidden');
            document.getElementById('criteria-container').classList.remove('hidden');

            // Filter evaluations for this intern
            const internEvals = weeklyEvaluations.filter(eval => eval.magang_id === magangId);

            // If we don't have data for this intern yet, we might need to fetch it
            if (internEvals.length === 0) {
                // Show loading state
                const tbody = document.getElementById('criteria-tbody');
                tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center">Loading evaluation data...</td></tr>';

                // Try to fetch data specifically for this intern if not already loaded
                fetch(`{{ route('api.evaluations') }}?periode_id=${currentPeriod}&week=${currentWeek}&magang_id=${magangId}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Add these evaluations to our existing data
                    if (data.evaluations && data.evaluations.length > 0) {
                        weeklyEvaluations = weeklyEvaluations.concat(
                            data.evaluations.filter(e => !weeklyEvaluations.some(we => we.evaluasi_id === e.evaluasi_id))
                        );
                        // Now retry showing evaluations with fresh data
                        showInternEvaluations(magangId, internName, jobId);
                    } else {
                        // No evaluations found
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center">
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    No evaluations found for this intern for Week ${currentWeek}.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center space-x-4">
                                        <a href="{{ route('evaluasi.create') }}?periode_id=${currentPeriod}&week=${currentWeek}&magang_id=${magangId}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Create New Evaluation
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `;

                        // Clear the total score
                        document.getElementById('total-score').textContent = '0.00';

                        // Hide SMART analysis
                        document.getElementById('smart-analysis').classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error fetching intern evaluations:', error);
                    tbody.innerHTML = `<tr><td colspan="4" class="px-6 py-4 text-center text-red-600">Error loading data: ${error.message}</td></tr>`;
                });
                return;
            }

            // Get the total score from the database
            // First check if we have at least one evaluation with a total_score property
            let totalScore = '0.00';
            if (internEvals.length > 0) {
                // Use the first evaluation's total_score as they should all be the same for this intern
                // for the same magang_id and minggu_ke
                if (internEvals[0].hasOwnProperty('total_score')) {
                    totalScore = parseFloat(internEvals[0].total_score).toFixed(2);
                }
            }

            // Update the displayed total score
            document.getElementById('total-score').textContent = totalScore;

            // Populate criteria table
            const tbody = document.getElementById('criteria-tbody');
            tbody.innerHTML = ''; // Clear existing rows

            // Create rows for each evaluation
            internEvals.forEach(eval => {
                const criteriaName = eval.criteria ?
                    `${eval.criteria.name} (${eval.criteria.code})` :
                    'General Evaluation';

                // Get rating value (assuming AJAX response now includes rating_value)
                const ratingValue = eval.criteria_rating_scale ?
                                    eval.criteria_rating_scale.rating_level : 0;

                // Create row with rating dropdown that will be populated
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 text-sm text-gray-900">${criteriaName}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <select class="rating-dropdown rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               data-evaluation-id="${eval.evaluasi_id}"
                               data-criteria-id="${eval.criteria_id}"
                               data-current-rating="${eval.criteria_rating_id || ''}">
                            <option value="">Loading ratings...</option>
                        </select>
                        <div class="update-status hidden mt-1 text-xs"></div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        ${ratingValue}
                        <span class="text-xs text-gray-500">
                            ${eval.criteria_rating_scale ? '(Rating level: ' + eval.criteria_rating_scale.rating_level + ')' : '(Not rated)'}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <a href="{{ url('evaluasi') }}/${eval.evaluasi_id}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="{{ url('evaluasi') }}/${eval.evaluasi_id}/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                    </td>
                `;

                // Add the row to the DOM
                tbody.appendChild(row);

                // Load ratings for this specific criterion
                if (eval.criteria_id) {
                    // Get the dropdown from the appended row
                    const dropdown = row.querySelector('.rating-dropdown');

                    // Call the function to populate ratings with a small delay to ensure DOM is ready
                    setTimeout(() => {
                        populateRatingsDropdown(dropdown, eval.criteria_id, eval.criteria_rating_id);
                    }, 10);
                } else {
                    // For evaluations without a specific criterion, just show "Not Rated Yet" option
                    const dropdown = row.querySelector('.rating-dropdown');
                    dropdown.innerHTML = '<option value="">Not Rated Yet</option>';
                }
            });

            // Add event listeners to the rating dropdowns
            document.querySelectorAll('.rating-dropdown').forEach(dropdown => {
                // Ensure the dropdown has all its options loaded properly
                if (dropdown.options.length <= 1 && dropdown.dataset.criteriaId) {
                    populateRatingsDropdown(dropdown, dropdown.dataset.criteriaId, dropdown.dataset.currentRating);
                }

                dropdown.addEventListener('change', function() {
                    updateRating(this.dataset.evaluationId, this.value, this);
                });
            });

            // Show SMART analysis for Cook and Pastry Chef positions
            const smartAnalysis = document.getElementById('smart-analysis');

            // Check if this is a Cook or Pastry Chef position
            if (['JOB001', 'JOB004'].includes(jobId)) {
                smartAnalysis.classList.remove('hidden');

                // Find SMART data for this intern
                let smartData = null;

                // Lookup in the appropriate job results
                if (smartResults[jobId]) {
                    smartData = smartResults[jobId].find(result => result.magang_id === magangId);
                }

                if (smartData) {
                    // Populate normalized scores
                    const normalizedScoresDiv = document.getElementById('normalized-scores');
                    let normalizedHtml = '<div class="space-y-3">';

                    smartData.score_details.forEach(detail => {
                        normalizedHtml += `
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>${detail.criteria_code} - ${detail.criteria_name}</span>
                                    <span>${detail.normalized_value.toFixed(4)}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: ${detail.normalized_value * 100}%"></div>
                                </div>
                            </div>
                        `;
                    });

                    normalizedHtml += '</div>';
                    normalizedScoresDiv.innerHTML = normalizedHtml;

                    // Populate weighted scores
                    const weightedScoresDiv = document.getElementById('weighted-scores');
                    let weightedHtml = '<div class="space-y-3">';

                    smartData.score_details.forEach(detail => {
                        weightedHtml += `
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>${detail.criteria_code} - ${detail.criteria_name}</span>
                                    <span>${detail.weighted_score.toFixed(4)}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: ${(detail.weighted_score / smartData.total_score) * 100}%"></div>
                                </div>
                            </div>
                        `;
                    });

                    weightedHtml += `
                        <div class="mt-2 pt-2 border-t">
                            <div class="flex justify-between text-sm font-medium">
                                <span>Total SMART Score</span>
                                <span>${smartData.total_score.toFixed(4)}</span>
                            </div>
                            <div class="flex justify-between text-xs mt-1">
                                <span>Rank</span>
                                <span class="px-2 py-0.5 bg-indigo-100 text-indigo-800 rounded-full">#${smartData.rank}</span>
                            </div>
                        </div>
                    `;

                    weightedHtml += '</div>';
                    weightedScoresDiv.innerHTML = weightedHtml;

                    // Populate calculation values table with real values
                    const calculationValuesBody = document.getElementById('calculation-values-body');
                    calculationValuesBody.innerHTML = ''; // Clear existing rows

                    // Sort the score details by criteria code for better readability
                    const sortedDetails = [...smartData.score_details].sort((a, b) =>
                        a.criteria_code.localeCompare(b.criteria_code));

                    sortedDetails.forEach(detail => {
                        const row = document.createElement('tr');
                        row.className = 'border-b';
                        row.innerHTML = `
                            <td class="p-2">${detail.criteria_code} - ${detail.criteria_name}</td>
                            <td class="p-2">${detail.weight.toFixed(4)}</td>
                            <td class="p-2">${detail.raw_value.toFixed(2)}</td>
                            <td class="p-2">${detail.min_value.toFixed(2)}</td>
                            <td class="p-2">${detail.max_value.toFixed(2)}</td>
                            <td class="p-2">${detail.normalized_value.toFixed(4)}</td>
                            <td class="p-2">${detail.weighted_score.toFixed(4)}</td>
                        `;
                        calculationValuesBody.appendChild(row);
                    });

                    // Update total SMART score and scaled score
                    document.getElementById('total-smart-value').textContent = smartData.total_score.toFixed(4);
                    document.getElementById('scaled-smart-value').textContent = (smartData.total_score * 5).toFixed(2);
                } else {
                    // No SMART data found
                    document.getElementById('normalized-scores').innerHTML =
                        '<p class="text-gray-500 text-sm italic">No SMART analysis data available</p>';
                    document.getElementById('weighted-scores').innerHTML =
                        '<p class="text-gray-500 text-sm italic">No SMART analysis data available</p>';
                    document.getElementById('calculation-values-body').innerHTML =
                        '<tr><td colspan="7" class="p-2 text-gray-500 text-sm italic">No calculation data available</td></tr>';
                    document.getElementById('total-smart-value').textContent = '0.000';
                    document.getElementById('scaled-smart-value').textContent = '0.00';
                }
            } else {
                smartAnalysis.classList.add('hidden');
            }
        }

        function updateRating(evaluationId, ratingId, dropdown) {
            // Show loading status
            const statusDiv = dropdown.nextElementSibling;
            statusDiv.textContent = 'Updating...';
            statusDiv.className = 'text-xs text-gray-600 mt-1';
            statusDiv.classList.remove('hidden');

            // Prepare the data to send
            const requestData = {
                evaluation_id: evaluationId,
                criteria_rating_id: ratingId || null // Ensure we send null if ratingId is empty
            };

            // Make an AJAX request to update the rating
            fetch('{{ url("api/evaluations/update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(requestData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Update failed');
                }

                // Update the rating value in the table (3rd cell)
                const row = dropdown.closest('tr');
                const scoreCell = row.cells[2];

                // Update with the actual rating value from the response
                const ratingValue = data.evaluation.rating_value || 0;
                scoreCell.textContent = ratingValue;

                // Add rating level info in a small text
                if (data.evaluation.criteria_rating_scale) {
                    const ratingInfo = document.createElement('span');
                    ratingInfo.className = 'text-xs text-gray-500';
                    ratingInfo.textContent = ` (Rating level: ${data.evaluation.criteria_rating_scale.rating_level})`;
                    scoreCell.appendChild(ratingInfo);
                } else {
                    const ratingInfo = document.createElement('span');
                    ratingInfo.className = 'text-xs text-gray-500';
                    ratingInfo.textContent = ' (Not rated)';
                    scoreCell.appendChild(ratingInfo);
                }

                // Update the total score at the bottom of the table
                // Ensure we use the total_score from the response, which comes from the database
                if (data.hasOwnProperty('total_score')) {
                    document.getElementById('total-score').textContent =
                        typeof data.total_score === 'number' ?
                        parseFloat(data.total_score).toFixed(2) :
                        '0.00';
                }

                // Show success message
                statusDiv.textContent = 'Updated successfully';
                statusDiv.className = 'text-xs text-green-600 mt-1';

                // Hide status after 3 seconds
                setTimeout(() => {
                    statusDiv.classList.add('hidden');
                }, 3000);

                // Update the local data
                weeklyEvaluations.forEach(eval => {
                    if (eval.evaluasi_id === evaluationId) {
                        eval.criteria_rating_id = ratingId;
                        eval.criteria_rating_scale = data.evaluation.criteria_rating_scale;
                        // Set total_score for all evaluations of this intern to keep it in sync
                        if (data.hasOwnProperty('total_score')) {
                            eval.total_score = data.total_score;
                        }
                    }
                });

                // Update SMART analysis if it's visible
                const smartAnalysis = document.getElementById('smart-analysis');
                if (smartAnalysis && !smartAnalysis.classList.contains('hidden')) {
                    // After updating the rating, refresh the SMART analysis
                    refreshSmartAnalysis();
                }

                // Update evaluation status overview if available
                updateEvaluationStatusOverview();
            })
            .catch(error => {
                console.error('Error updating rating:', error);
                // Show error message
                statusDiv.textContent = 'Error updating rating: ' + error.message;
                statusDiv.className = 'text-xs text-red-600 mt-1';
            });
        }

        // Function to refresh SMART analysis without page reload
        function refreshSmartAnalysis() {
            const smartAnalysis = document.getElementById('smart-analysis');
            if (!smartAnalysis || smartAnalysis.classList.contains('hidden')) return;

            // Add loading indicator
            let loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'text-center py-4';
            loadingIndicator.innerHTML = '<p class="text-gray-500">Refreshing SMART analysis...</p>';

            // Add to normalized scores section
            const normalizedScores = document.getElementById('normalized-scores');
            if (normalizedScores) {
                normalizedScores.innerHTML = '';
                normalizedScores.appendChild(loadingIndicator.cloneNode(true));
            }

            // Add to weighted scores section
            const weightedScores = document.getElementById('weighted-scores');
            if (weightedScores) {
                weightedScores.innerHTML = '';
                weightedScores.appendChild(loadingIndicator);
            }

            // Get current intern and week from the page
            const selectedInternId = document.querySelector('h2[data-intern-id]')?.dataset.internId;
            const currentWeek = parseInt(document.getElementById('week-selector')?.value);

            if (!selectedInternId || !currentWeek) {
                console.error('Missing intern ID or week number for SMART refresh');
                return;
            }

            // Make AJAX request to get updated SMART data
            fetch(`/api/evaluations?magang_id=${selectedInternId}&week=${currentWeek}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                // If we have smart data, update the sections
                const smartResults = data.smartResults;
                if (smartResults && Object.keys(smartResults).length > 0) {
                    const jobId = Object.keys(smartResults)[0]; // Get first job ID (should only be one)
                    const smartData = smartResults[jobId];

                    // Update normalized scores
                    if (normalizedScores) {
                        let html = '<table class="w-full text-sm">';
                        html += '<thead><tr><th class="text-left">Criteria</th><th class="text-right">Value</th></tr></thead>';
                        html += '<tbody>';

                        if (smartData.interns && smartData.interns.length > 0) {
                            // Find the current intern in the results
                            const internData = smartData.interns.find(intern => intern.magang_id === selectedInternId);

                            if (internData && internData.score_details) {
                                internData.score_details.forEach(detail => {
                                    html += `<tr>
                                        <td>${detail.criteria_name} (${detail.criteria_code})</td>
                                        <td class="text-right">${parseFloat(detail.normalized_value).toFixed(4)}</td>
                                    </tr>`;
                                });
                            }
                        }

                        html += '</tbody></table>';
                        normalizedScores.innerHTML = html;
                    }

                    // Update weighted scores
                    if (weightedScores) {
                        let html = '<table class="w-full text-sm">';
                        html += '<thead><tr><th class="text-left">Criteria</th><th class="text-right">Weight</th><th class="text-right">Contribution</th></tr></thead>';
                        html += '<tbody>';

                        if (smartData.interns && smartData.interns.length > 0) {
                            // Find the current intern in the results
                            const internData = smartData.interns.find(intern => intern.magang_id === selectedInternId);

                            if (internData && internData.score_details) {
                                internData.score_details.forEach(detail => {
                                    html += `<tr>
                                        <td>${detail.criteria_name} (${detail.criteria_code})</td>
                                        <td class="text-right">${parseFloat(detail.weight).toFixed(4)}</td>
                                        <td class="text-right">${parseFloat(detail.weighted_score).toFixed(4)}</td>
                                    </tr>`;
                                });

                                // Add total row
                                html += `<tr class="font-semibold border-t">
                                    <td colspan="2" class="text-right">Total:</td>
                                    <td class="text-right">${parseFloat(internData.total_score).toFixed(4)}</td>
                                </tr>`;
                            }
                        }

                        html += '</tbody></table>';
                        weightedScores.innerHTML = html;
                    }

                    // Update any other SMART-related elements
                    const totalSmartValue = document.getElementById('total-smart-value');
                    const scaledSmartValue = document.getElementById('scaled-smart-value');

                    if (totalSmartValue && scaledSmartValue && smartData.interns && smartData.interns.length > 0) {
                        const internData = smartData.interns.find(intern => intern.magang_id === selectedInternId);

                        if (internData) {
                            totalSmartValue.textContent = parseFloat(internData.total_score).toFixed(4);
                            scaledSmartValue.textContent = parseFloat(internData.total_score * 5).toFixed(2);
                        }
                    }
                } else {
                    // No SMART data found
                    if (normalizedScores) {
                        normalizedScores.innerHTML = '<p class="text-gray-500 text-sm italic">No SMART analysis data available</p>';
                    }
                    if (weightedScores) {
                        weightedScores.innerHTML = '<p class="text-gray-500 text-sm italic">No SMART analysis data available</p>';
                    }
                }
            })
            .catch(error => {
                console.error('Error refreshing SMART analysis:', error);

                // Show error message
                if (normalizedScores) {
                    normalizedScores.innerHTML = '<p class="text-red-500 text-sm">Error refreshing SMART analysis</p>';
                }
                if (weightedScores) {
                    weightedScores.innerHTML = '<p class="text-red-500 text-sm">Error refreshing SMART analysis</p>';
                }
            });
        }

        // Function to update evaluation status overview
        function updateEvaluationStatusOverview() {
            // Make AJAX request to get updated status data
            // This could be fetched from the existing API or a new endpoint
            // For now, we'll just refresh the page elements based on the current data

            // Update status cards if they exist
            document.querySelectorAll('[data-status-card]').forEach(card => {
                const magangId = card.dataset.magangId;
                const weekNumber = card.dataset.week;

                // Find all evaluations for this intern and week
                const evaluations = weeklyEvaluations.filter(
                    eval => eval.magang_id === magangId && eval.minggu_ke == weekNumber
                );

                if (evaluations.length > 0) {
                    // Count how many evaluations have ratings
                    const ratedCount = evaluations.filter(eval => eval.criteria_rating_id).length;
                    const totalCount = evaluations.length;

                    // Update progress
                    const progressEl = card.querySelector('.progress-value');
                    if (progressEl) {
                        const percentage = totalCount ? Math.round((ratedCount / totalCount) * 100) : 0;
                        progressEl.style.width = `${percentage}%`;
                    }

                    // Update text counter
                    const counterEl = card.querySelector('[data-counter]');
                    if (counterEl) {
                        counterEl.textContent = `${ratedCount}/${totalCount}`;
                    }

                    // Update status text
                    const statusEl = card.querySelector('[data-status]');
                    if (statusEl) {
                        if (ratedCount === 0) {
                            statusEl.textContent = 'Not Started';
                            statusEl.className = 'px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full';
                        } else if (ratedCount < totalCount) {
                            statusEl.textContent = 'In Progress';
                            statusEl.className = 'px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full';
                        } else {
                            statusEl.textContent = 'Completed';
                            statusEl.className = 'px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full';
                        }
                    }
                }
            });
        }

        // Helper function to populate ratings for a specific criterion from preloaded data
        function populateRatingsDropdown(dropdown, criteriaId, currentRatingId) {
            // Build options HTML
            let optionsHtml = '<option value="">Not Rated Yet</option>';

            console.log(`Populating ratings for criteria ${criteriaId}, current rating: ${currentRatingId}`);

            if (criteriaId && allRatings[criteriaId]) {
                console.log(`Found ${allRatings[criteriaId].length} preloaded ratings`);
                allRatings[criteriaId].forEach(rating => {
                    const selected = rating.id == currentRatingId ? 'selected' : '';
                    optionsHtml += `<option value="${rating.id}" ${selected}>${rating.name} - Nilai: ${rating.rating_level}</option>`;
                });

                // Update dropdown options
                dropdown.innerHTML = optionsHtml;
            } else {
                console.log(`No preloaded ratings found, fetching now`);

                // If we don't have the ratings preloaded, fetch them now
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
                        console.log(`Loaded ${data.ratings.length} ratings for criteria ${criteriaId}`);

                        // Build options HTML
                        let optionsHtml = '<option value="">Not Rated Yet</option>';

                        data.ratings.forEach(rating => {
                            const selected = rating.id == currentRatingId ? 'selected' : '';
                            optionsHtml += `<option value="${rating.id}" ${selected}>${rating.name} - Nilai: ${rating.rating_level}</option>`;
                        });

                        // Update dropdown options
                        dropdown.innerHTML = optionsHtml;
                    } else {
                        console.error('Error loading ratings:', data.message);
                        dropdown.innerHTML = '<option value="">Error loading ratings</option>';
                    }
                })
                .catch(error => {
                    console.error('Error loading ratings:', error);
                    dropdown.innerHTML = '<option value="">Error loading ratings</option>';
                });
            }
        }

                // Auto-submit when period filter changes
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM content loaded');

            // Initialize click handlers for week cards explicitly as a fallback
            document.querySelectorAll('#week-cards > div').forEach(card => {
                card.addEventListener('click', function() {
                    const weekText = this.querySelector('h3').textContent;
                    const week = parseInt(weekText.replace('Week ', ''));
                    console.log('Week card clicked via event listener:', week);
                    loadWeekEvaluations('{{ $selectedPeriodeId }}', week);
                });
            });

            // Preload all ratings data
            setTimeout(() => {
                preloadAllRatings();
            }, 100);

            const periodeFilter = document.getElementById('periode_filter');
            if (periodeFilter) {
                periodeFilter.addEventListener('change', function() {
                    // Update current period before submitting
                    currentPeriod = this.value;
                    // Show a loading indicator
                    const loadingDiv = document.createElement('div');
                    loadingDiv.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                    loadingDiv.innerHTML = `
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <svg class="animate-spin h-8 w-8 text-indigo-600 mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <p class="text-gray-700">Loading data...</p>
                        </div>
                    `;
                    document.body.appendChild(loadingDiv);

                    // Submit the form
                    this.form.submit();
                });
            }
        });

        // Add a function to handle the Not Evaluated status - checks if the week exists first
        function handleNotEvaluated(periodeId, week, magangId, internName, jobId) {
            // First check if data for this week exists but is just not evaluated
            fetch(`{{ route('api.evaluations') }}?periode_id=${periodeId}&week=${week}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                // Check if there's any data for this week (for any intern)
                if (data.evaluations && data.evaluations.length > 0) {
                    // The week exists, so show the regular evaluation view
                    loadWeekEvaluations(periodeId, week);
                    setTimeout(() => showInternEvaluations(magangId, internName, jobId), 500);
                } else {
                    // Week doesn't have any data, show the create prompt
                    showCreateEvaluationPrompt(periodeId, week, magangId, internName);
                }
            })
            .catch(error => {
                console.error('Error checking week data:', error);
                // If there's an error, default to showing the create prompt
                showCreateEvaluationPrompt(periodeId, week, magangId, internName);
            });
        }

        // Function to show a create evaluation prompt when there's no existing data
        function showCreateEvaluationPrompt(periodeId, week, magangId, internName) {
            document.getElementById('evaluation-table-container').classList.add('hidden');
            document.getElementById('criteria-container').classList.remove('hidden');

            // Update the intern title
            document.getElementById('intern-title').textContent = `Evaluations for ${internName} - Week ${week}`;

            // Create a prompt to add a new evaluation
            const tbody = document.getElementById('criteria-tbody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        No evaluations found for this intern for Week ${week}.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('evaluasi.create') }}?periode_id=${periodeId}&week=${week}&magang_id=${magangId}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create New Evaluation
                            </a>
                        </div>
                    </td>
                </tr>
            `;

            // Clear the total score
            document.getElementById('total-score').textContent = '0.00';

            // Hide SMART analysis
            document.getElementById('smart-analysis').classList.add('hidden');
        }
    </script>
</x-app-layout>
