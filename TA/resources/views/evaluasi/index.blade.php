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
                        <h2 class="text-lg font-medium mb-3">SMART Evaluation Dashboards</h2>
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

                    <!-- Week Selection Cards -->
                    @if($weekCount > 0)
                        <div id="week-cards" class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-6">
                            @for($week = 1; $week <= $weekCount; $week++)
                                <div class="bg-white shadow rounded-lg border border-gray-200 hover:shadow-md transition-shadow cursor-pointer overflow-hidden"
                                    onclick="loadWeekEvaluations('{{ $selectedPeriodeId }}', {{ $week }})">
                                    <div class="p-4">
                                        <h3 class="text-lg font-medium text-gray-900">Week {{ $week }}</h3>
                                        <p class="mt-2 text-sm text-gray-600">
                                            @php
                                                // Count interns with evaluations for this week
                                                $internCount = 0;
                                                if (isset($evaluationsByWeek[$week])) {
                                                    $internCount = $evaluationsByWeek[$week]->count();
                                                }
                                            @endphp
                                            {{ $internCount }} {{ Str::plural('intern', $internCount) }} evaluated
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
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average Score</th>
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

                                <!-- Calculation Details Explanation -->
                                <div class="mt-4 border-t pt-4">
                                    <h4 class="text-md font-medium mb-2">Calculation Method Details</h4>
                                    <div class="bg-gray-50 p-4 rounded text-sm">
                                        <p class="mb-3">The weekly total score is calculated using the SMART (Simple Multi-Attribute Rating Technique) methodology in 5 steps:</p>

                                        <ol class="list-decimal pl-5 space-y-3">
                                            <li>
                                                <strong>Data Collection:</strong> Raw scores are gathered for each criterion (from rating scale values).
                                            </li>
                                            <li>
                                                <strong>Normalization:</strong> Each criterion score is normalized to a 0-1 scale using:
                                                <div class="bg-white p-2 my-1 border rounded font-mono text-xs">
                                                    Normalized Value = (Raw Value - Minimum Value) / (Maximum Value - Minimum Value)
                                                </div>
                                                <span class="text-gray-600">This creates a comparable scale across all criteria. When all interns have the same score (min=max), all normalized values become 1.</span>
                                            </li>
                                            <li>
                                                <strong>Weighting:</strong> Normalized scores are multiplied by criterion weights:
                                                <div class="bg-white p-2 my-1 border rounded font-mono text-xs">
                                                    Weighted Score = Normalized Value × Criterion Weight
                                                </div>
                                                <span class="text-gray-600">Weights are determined through AHP analysis and sum to 1.</span>
                                            </li>
                                            <li>
                                                <strong>Summation:</strong> All weighted scores are added together to get the total weekly score:
                                                <div class="bg-white p-2 my-1 border rounded font-mono text-xs">
                                                    Total Weekly Score = Sum of all Weighted Scores
                                                </div>
                                            </li>
                                            <li>
                                                <strong>Storage:</strong> The final score is stored in the <code>total_skor_minggu_magang</code> table linked to this intern and week.
                                            </li>
                                        </ol>

                                        <div class="mt-3 pt-3 border-t text-gray-700">
                                            <p><strong>Scaling:</strong> For display purposes, scores may be multiplied by 5 to convert from the 0-1 scale to a 0-5 scale.</p>
                                            <p class="mt-1"><strong>Note:</strong> Final overall scores use a weighted average of weekly scores, with later weeks given higher weight.</p>
                                        </div>

                                        <!-- Static Numerical Example -->
                                        <div class="mt-4 pt-3 border-t border-gray-300">
                                            <h5 class="font-medium mb-2 text-gray-800">Numerical Example Walkthrough:</h5>
                                            <div class="bg-white p-3 border rounded">
                                                <p class="mb-2 text-sm font-medium">Example for a Cook position intern evaluated on 3 key criteria:</p>

                                                <div class="mt-3">
                                                    <p class="font-medium mb-1">Step 1: Data Collection - Raw Scores</p>
                                                    <table class="min-w-full text-xs mb-3 border">
                                                        <thead class="bg-gray-100">
                                                            <tr>
                                                                <th class="p-2 text-left border">Criteria</th>
                                                                <th class="p-2 text-left border">Code</th>
                                                                <th class="p-2 text-left border">Raw Score</th>
                                                                <th class="p-2 text-left border">Weight</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border-b">
                                                                <td class="p-2 border">Cooking Skills</td>
                                                                <td class="p-2 border">K1</td>
                                                                <td class="p-2 border">3.0</td>
                                                                <td class="p-2 border">0.4162</td>
                                                            </tr>
                                                            <tr class="border-b">
                                                                <td class="p-2 border">Food Quality</td>
                                                                <td class="p-2 border">K2</td>
                                                                <td class="p-2 border">3.5</td>
                                                                <td class="p-2 border">0.2618</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-2 border">Team Work</td>
                                                                <td class="p-2 border">K5</td>
                                                                <td class="p-2 border">4.0</td>
                                                                <td class="p-2 border">0.0624</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="mt-4">
                                                    <p class="font-medium mb-1">Step 2: Normalization - Range for all interns</p>
                                                    <table class="min-w-full text-xs mb-3 border">
                                                        <thead class="bg-gray-100">
                                                            <tr>
                                                                <th class="p-2 text-left border">Criteria</th>
                                                                <th class="p-2 text-left border">Raw Score</th>
                                                                <th class="p-2 text-left border">Min Value</th>
                                                                <th class="p-2 text-left border">Max Value</th>
                                                                <th class="p-2 text-left border">Calculation</th>
                                                                <th class="p-2 text-left border">Normalized</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border-b">
                                                                <td class="p-2 border">K1</td>
                                                                <td class="p-2 border">3.0</td>
                                                                <td class="p-2 border">2.0</td>
                                                                <td class="p-2 border">4.0</td>
                                                                <td class="p-2 border text-xs">(3.0 - 2.0) / (4.0 - 2.0)</td>
                                                                <td class="p-2 border">0.5000</td>
                                                            </tr>
                                                            <tr class="border-b">
                                                                <td class="p-2 border">K2</td>
                                                                <td class="p-2 border">3.5</td>
                                                                <td class="p-2 border">2.5</td>
                                                                <td class="p-2 border">4.0</td>
                                                                <td class="p-2 border text-xs">(3.5 - 2.5) / (4.0 - 2.5)</td>
                                                                <td class="p-2 border">0.6667</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-2 border">K5</td>
                                                                <td class="p-2 border">4.0</td>
                                                                <td class="p-2 border">3.0</td>
                                                                <td class="p-2 border">4.0</td>
                                                                <td class="p-2 border text-xs">(4.0 - 3.0) / (4.0 - 3.0)</td>
                                                                <td class="p-2 border">1.0000</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="mt-4">
                                                    <p class="font-medium mb-1">Step 3: Weighting - Multiply normalized scores by criteria weights</p>
                                                    <table class="min-w-full text-xs mb-3 border">
                                                        <thead class="bg-gray-100">
                                                            <tr>
                                                                <th class="p-2 text-left border">Criteria</th>
                                                                <th class="p-2 text-left border">Normalized Score</th>
                                                                <th class="p-2 text-left border">Weight</th>
                                                                <th class="p-2 text-left border">Calculation</th>
                                                                <th class="p-2 text-left border">Weighted Score</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border-b">
                                                                <td class="p-2 border">K1</td>
                                                                <td class="p-2 border">0.5000</td>
                                                                <td class="p-2 border">0.4162</td>
                                                                <td class="p-2 border text-xs">0.5000 × 0.4162</td>
                                                                <td class="p-2 border">0.2081</td>
                                                            </tr>
                                                            <tr class="border-b">
                                                                <td class="p-2 border">K2</td>
                                                                <td class="p-2 border">0.6667</td>
                                                                <td class="p-2 border">0.2618</td>
                                                                <td class="p-2 border text-xs">0.6667 × 0.2618</td>
                                                                <td class="p-2 border">0.1745</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-2 border">K5</td>
                                                                <td class="p-2 border">1.0000</td>
                                                                <td class="p-2 border">0.0624</td>
                                                                <td class="p-2 border text-xs">1.0000 × 0.0624</td>
                                                                <td class="p-2 border">0.0624</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="mt-4">
                                                    <p class="font-medium mb-1">Step 4: Summation - Add all weighted scores</p>
                                                    <div class="bg-gray-50 p-3 border rounded text-sm">
                                                        <p><strong>Total Weighted Score = </strong> 0.2081 + 0.1745 + 0.0624 = <strong>0.4450</strong></p>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <p class="font-medium mb-1">Step 5: Storage and Scaling</p>
                                                    <div class="bg-gray-50 p-3 border rounded text-sm">
                                                        <p><strong>Store in Database:</strong> In total_skor_minggu_magang table with magang_id, minggu_ke=1, total_skor=0.4450</p>
                                                        <p class="mt-2"><strong>Scale to 0-5 Range:</strong> 0.4450 × 5 = <strong>2.225</strong> (stored as 2.23 in the interface)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Real Calculation Values -->
                                        <div class="mt-4 pt-3 border-t border-gray-300">
                                            <h5 class="font-medium mb-2 text-gray-800">Actual Calculation Values:</h5>
                                            <div class="bg-white p-3 border rounded">
                                                <p class="mb-2">Current calculation values for this intern:</p>

                                                <table class="min-w-full text-xs mb-3" id="calculation-values-table">
                                                    <thead class="bg-gray-100">
                                                        <tr>
                                                            <th class="p-2 text-left">Criteria</th>
                                                            <th class="p-2 text-left">Weight</th>
                                                            <th class="p-2 text-left">Raw Score</th>
                                                            <th class="p-2 text-left">Min Value</th>
                                                            <th class="p-2 text-left">Max Value</th>
                                                            <th class="p-2 text-left">Normalized</th>
                                                            <th class="p-2 text-left">Weighted</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="calculation-values-body">
                                                        <!-- This will be populated by JavaScript with actual values -->
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="bg-gray-100 font-medium">
                                                            <td class="p-2" colspan="6">Total SMART Score:</td>
                                                            <td class="p-2" id="total-smart-value">0.000</td>
                                                        </tr>
                                                        <tr class="bg-gray-100 font-medium">
                                                            <td class="p-2" colspan="6">Scaled Score (0-5):</td>
                                                            <td class="p-2" id="scaled-smart-value">0.00</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
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
    </div>

    <!-- JavaScript for handling the evaluations display -->
    <script>
        let currentWeek = 0;
        let currentPeriod = '';
        let currentMagangId = '';
        let weeklyEvaluations = [];
        let smartResults = {};
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

        function loadWeekEvaluations(periodeId, week) {
            currentWeek = week;
            currentPeriod = periodeId;

            // Update the week title and create link
            document.getElementById('week-title').textContent = `Week ${week} Evaluations`;
            const createLink = document.getElementById('create-link');
            createLink.href = `{{ route('evaluasi.create') }}?periode_id=${periodeId}&week=${week}`;
            createLink.textContent = `Add Evaluation for Week ${week}`;

            // Hide week cards and show evaluation table
            document.getElementById('week-cards').classList.add('hidden');
            document.getElementById('evaluation-table-container').classList.remove('hidden');
            document.getElementById('criteria-container').classList.add('hidden');

            // Show loading indicator
            const tbody = document.getElementById('interns-tbody');
            tbody.innerHTML = '<tr><td colspan="4" class="px-6 py-4 text-center">Loading...</td></tr>';

            // Fetch data for the selected week
            fetchWeekData(periodeId, week);
        }

        function fetchWeekData(periodeId, week) {
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
                    document.getElementById('interns-tbody').innerHTML =
                        `<tr><td colspan="4" class="px-6 py-4 text-center text-red-600">Error loading evaluations: ${error.message}</td></tr>`;
                });
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

                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${intern.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${intern.job}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${intern.averageScore}</td>
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

            // Calculate total score (sum of all criteria scores)
            const totalScore = internEvals.reduce((sum, eval) => sum + parseFloat(eval.skor_minggu), 0).toFixed(2);
            document.getElementById('total-score').textContent = totalScore;

            // Populate criteria table
            const tbody = document.getElementById('criteria-tbody');
            tbody.innerHTML = ''; // Clear existing rows

            internEvals.forEach(eval => {
                const criteriaName = eval.criteria ?
                    `${eval.criteria.name} (${eval.criteria.code})` :
                    'General Evaluation';

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 text-sm text-gray-900">${criteriaName}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <select class="rating-dropdown rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                               data-evaluation-id="${eval.evaluasi_id}">
                            <option value="">Not Rated Yet</option>
                            @foreach(\App\Models\RatingScale::orderBy('value')->get() as $rating)
                                <option value="{{ $rating->rating_id }}"
                                        ${eval.rating_id === "{{ $rating->rating_id }}" ? 'selected' : ''}>
                                    {{ $rating->name }} ({{ $rating->singkatan }}) - {{ $rating->value }}
                                </option>
                            @endforeach
                        </select>
                        <div class="update-status hidden mt-1 text-xs"></div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        ${eval.skor_minggu * 10}
                        <span class="text-xs text-gray-500">
                            ${eval.rating_scale ? '(Original rating: ' + eval.rating_scale.value + ')' : '(Not rated)'}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <a href="/evaluasi/${eval.evaluasi_id}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="/evaluasi/${eval.evaluasi_id}/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Add event listeners to the rating dropdowns
            document.querySelectorAll('.rating-dropdown').forEach(dropdown => {
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

            // Make an AJAX request to update the rating
            fetch('/api/evaluations/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    evaluation_id: evaluationId,
                    rating_id: ratingId
                })
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

                // Update the score in the table (3rd cell)
                const row = dropdown.closest('tr');
                const scoreCell = row.cells[2];
                scoreCell.textContent = data.evaluation.skor_minggu * 10;

                // Update the total score at the bottom of the table
                document.getElementById('total-score').textContent = (parseFloat(data.total_score) * 10).toFixed(0);

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
                        eval.rating_id = ratingId;
                        eval.skor_minggu = data.evaluation.skor_minggu;
                        eval.rating_scale = data.evaluation.rating_scale;
                    }
                });
            })
            .catch(error => {
                console.error('Error updating rating:', error);
                // Show error message
                statusDiv.textContent = 'Error updating rating: ' + error.message;
                statusDiv.className = 'text-xs text-red-600 mt-1';
            });
        }

        // Auto-submit when period filter changes
        document.addEventListener('DOMContentLoaded', function() {
            const periodeFilter = document.getElementById('periode_filter');
            if (periodeFilter) {
                periodeFilter.addEventListener('change', function() {
                    this.form.submit();
                });
            }
        });
    </script>
</x-app-layout>
