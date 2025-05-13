<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            SMART Calculation Dashboard - {{ $criteria->isNotEmpty() ? $criteria->first()->job->nama_job : 'No job selected' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('evaluasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to Evaluations
                        </a>
                    </div>

                    <!-- Filter Controls -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <form method="GET" action="{{ route('test.evaluasi.dashboard') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="job_id" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                                <select id="job_id" name="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->job_id }}" {{ $jobId == $job->job_id ? 'selected' : '' }}>
                                            {{ $job->nama_job }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="periode_id" class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                                <select id="periode_id" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach($periods as $period)
                                        <option value="{{ $period->periode_id }}" {{ $selectedPeriodeId == $period->periode_id ? 'selected' : '' }}>
                                            {{ $period->nama_periode }} ({{ $period->tanggal_mulai->format('d M Y') }} - {{ $period->tanggal_selesai->format('d M Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Apply Filters
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- SMART Method Information -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6 border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">About SMART Method</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                SMART (Simple Multi-Attribute Rating Technique) is a decision support method that evaluates
                                alternatives based on multiple criteria with different weights. The process involves:
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-md font-medium text-gray-800 mb-2">1. Criteria Weights</h4>
                                    <p class="text-sm text-gray-600">
                                        Weights are determined using AHP (Analytic Hierarchy Process) through pairwise comparisons
                                        of criteria importance.
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-md font-medium text-gray-800 mb-2">2. Normalization</h4>
                                    <p class="text-sm text-gray-600">
                                        Raw scores are normalized to a 0-1 scale to make them comparable across different criteria.
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-md font-medium text-gray-800 mb-2">3. Weighted Calculation</h4>
                                    <p class="text-sm text-gray-600">
                                        Normalized values are multiplied by criteria weights and summed to get a final score for ranking.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Criteria Weights -->
                    @if(isset($criteria) && $criteria->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6 border border-gray-200">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Criteria Weights (AHP Method)</h3>
                                <a href="{{ route('ahp.index', $jobId) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Recalculate Weights
                                </a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Criteria Weights Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($criteria->sortByDesc('weight') as $criterion)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $criterion->code }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $criterion->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <div class="flex items-center">
                                                        <span class="mr-2">{{ number_format($criterion->weight, 4) }}</span>
                                                        <div class="w-24 bg-gray-200 rounded-full h-2.5">
                                                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $criterion->weight * 100 }}%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Weight Visualization -->
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="text-md font-medium text-gray-800 mb-4">Criteria Weight Distribution</h4>
                                    <div class="space-y-3">
                                        @foreach($criteria as $criterion)
                                        <div>
                                            <div class="flex justify-between text-sm mb-1">
                                                <span>{{ $criterion->code }} - {{ $criterion->name }}</span>
                                                <span>{{ number_format($criterion->weight * 100, 1) }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $criterion->weight * 100 }}%"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-4 text-xs text-gray-500">
                                        These weights were calculated using the AHP method and determine the importance of each criterion in the SMART calculation.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Weekly Rankings -->
                    @if(isset($weeklyRankings) && $weekCount > 0)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6 border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Weekly SMART Rankings</h3>

                            <!-- Week Tabs -->
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                    @for($week = 1; $week <= $weekCount; $week++)
                                    <button type="button" class="week-tab {{ $week == 1 ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-week="{{ $week }}">
                                        Week {{ $week }}
                                    </button>
                                    @endfor
                                </nav>
                            </div>

                            <!-- Week Panels -->
                            @for($week = 1; $week <= $weekCount; $week++)
                            <div id="week-panel-{{ $week }}" class="week-panel {{ $week == 1 ? '' : 'hidden' }} mt-4">
                                @if(isset($weeklyRankings[$week]) && count($weeklyRankings[$week]) > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Score</th>
                                                @foreach($criteria as $criterion)
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $criterion->code }}</th>
                                                @endforeach
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($weeklyRankings[$week] as $ranking)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-indigo-100 text-indigo-800">
                                                        {{ $ranking['rank'] }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $ranking['pelamar_nama'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($ranking['total_score'], 4) }}</td>

                                                @foreach($criteria as $criterion)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        @php
                                                            $found = false;
                                                            $criteriaDetail = null;

                                                            // Find this criterion in the score details
                                                            foreach($ranking['score_details'] as $detail) {
                                                                if($detail['criteria_id'] === $criterion->criteria_id) {
                                                                    $found = true;
                                                                    $criteriaDetail = $detail;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        @if($found)
                                                            <span title="Raw: {{ number_format($criteriaDetail['raw_value'], 2) }} | Normalized: {{ number_format($criteriaDetail['normalized_value'], 4) }}">
                                                                {{ number_format($criteriaDetail['weighted_score'], 4) }}
                                                            </span>
                                                        @else
                                                            <span class="text-gray-400">-</span>
                                                        @endif
                                                    </td>
                                                @endforeach

                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    @php
                                                        // Find the magang record for this intern
                                                        $internRecord = null;
                                                        foreach($interns as $intern) {
                                                            if($intern->magang_id === $ranking['magang_id']) {
                                                                $internRecord = $intern;
                                                                break;
                                                            }
                                                        }
                                                    @endphp

                                                    @if($internRecord)
                                                        <a href="{{ route('magang.show', $internRecord) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="text-center py-4 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500">No rankings available for Week {{ $week }}.</p>
                                </div>
                                @endif

                                <!-- SMART Calculation Methodology For This Week -->
                                @if(isset($weeklyRankings[$week]) && count($weeklyRankings[$week]) > 0 && isset($weeklyRankings[$week][0]['score_details'][0]))
                                <div class="mt-8 bg-indigo-50 p-6 rounded-lg">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-indigo-900">SMART Calculation Methodology</h3>
                                        <button id="toggle-methodology-{{ $week }}" class="text-sm text-indigo-700 hover:text-indigo-900 font-medium flex items-center">
                                            <span>Show Calculation Steps</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div id="methodology-content-{{ $week }}" class="hidden space-y-6">
                                        <p class="text-sm text-gray-700">
                                            The SMART (Simple Multi-Attribute Rating Technique) method is used to evaluate and rank interns based on multiple criteria.
                                            Below is a detailed explanation of how the calculations are performed:
                                        </p>

                                        <!-- Example calculation using first intern and criterion -->
                                        @php
                                            try {
                                                $exampleIntern = isset($weeklyRankings[$week][0]) ? $weeklyRankings[$week][0] : null;
                                                $exampleCriterion = null;
                                                if ($exampleIntern && isset($exampleIntern['score_details']) &&
                                                    is_array($exampleIntern['score_details']) &&
                                                    !empty($exampleIntern['score_details'])) {
                                                    $exampleCriterion = $exampleIntern['score_details'][0];
                                                }
                                            } catch (\Exception $e) {
                                                $exampleIntern = null;
                                                $exampleCriterion = null;
                                            }
                                        @endphp

                                        @if($exampleIntern && $exampleCriterion)
                                        <div class="bg-white rounded-lg border border-indigo-100 overflow-hidden">
                                            <div class="bg-indigo-100 px-4 py-2">
                                                <h4 class="font-medium text-indigo-800">Example Calculation for {{ $exampleIntern['pelamar_nama'] }}</h4>
                                            </div>
                                            <div class="p-4">
                                                <div class="space-y-4">
                                                    <div>
                                                        <h5 class="font-medium text-gray-700 mb-1">Step 1: Input Values</h5>
                                                        <p class="text-sm text-gray-600 mb-2">Raw evaluation scores for each criterion:</p>
                                                        <div class="bg-gray-50 p-3 rounded">
                                                            <p class="text-sm">Criterion: <span class="font-medium">{{ $exampleCriterion['criteria_name'] }} ({{ $exampleCriterion['criteria_code'] }})</span></p>
                                                            <p class="text-sm">Raw Score: <span class="font-medium">{{ number_format($exampleCriterion['raw_value'], 2) }}</span></p>
                                                            <p class="text-sm">Weight: <span class="font-medium">{{ number_format($exampleCriterion['weight'], 4) }}</span></p>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <h5 class="font-medium text-gray-700 mb-1">Step 2: Normalization (Utility Value)</h5>
                                                        <p class="text-sm text-gray-600 mb-2">Formula: <code>Utility Value = (x - min) / (max - min)</code></p>
                                                        <div class="bg-gray-50 p-3 rounded">
                                                            @php
                                                                try {
                                                                    // Find all scores for this criteria to get min/max
                                                                    $criteriaId = $exampleCriterion['criteria_id'] ?? null;
                                                                    $allCriteriaScores = [];

                                                                    // Collect all scores for this criterion in this week
                                                                    if ($criteriaId && isset($weeklyRankings[$week]) && is_array($weeklyRankings[$week])) {
                                                                        foreach($weeklyRankings[$week] as $rankingData) {
                                                                            if (isset($rankingData['score_details']) && is_array($rankingData['score_details'])) {
                                                                                foreach($rankingData['score_details'] as $detail) {
                                                                                    if(isset($detail['criteria_id']) && $detail['criteria_id'] === $criteriaId && isset($detail['raw_value'])) {
                                                                                        $allCriteriaScores[] = $detail['raw_value'];
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }

                                                                    $minScore = !empty($allCriteriaScores) ? min($allCriteriaScores) : 0;
                                                                    $maxScore = !empty($allCriteriaScores) ? max($allCriteriaScores) : 0;
                                                                    $rawValue = $exampleCriterion['raw_value'] ?? 0;
                                                                    $normalizedValue = $exampleCriterion['normalized_value'] ?? 0;
                                                                } catch (\Exception $e) {
                                                                    // Default values in case of error
                                                                    $minScore = 0;
                                                                    $maxScore = 0;
                                                                    $rawValue = 0;
                                                                    $normalizedValue = 0;
                                                                }
                                                            @endphp
                                                            <p class="text-sm mb-2">Calculation: ({{ number_format($rawValue, 2) }} - {{ number_format($minScore, 2) }}) / ({{ number_format($maxScore, 2) }} - {{ number_format($minScore, 2) }}) = {{ number_format($normalizedValue, 4) }}</p>
                                                            <p class="text-sm">Normalized Value: <span class="font-medium">{{ number_format($normalizedValue, 4) }}</span></p>
                                                            <p class="text-xs text-gray-500">This converts the raw score to a 0-1 scale based on min and max values across all interns.</p>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <h5 class="font-medium text-gray-700 mb-1">Step 3: Weighted Score Calculation</h5>
                                                        <p class="text-sm text-gray-600 mb-2">Formula: <code>Weighted Score = Utility Value × Weight</code></p>
                                                        <div class="bg-gray-50 p-3 rounded">
                                                            <p class="text-sm">{{ number_format($exampleCriterion['normalized_value'], 4) }} × {{ number_format($exampleCriterion['weight'], 4) }} = <span class="font-medium">{{ number_format($exampleCriterion['weighted_score'], 4) }}</span></p>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <h5 class="font-medium text-gray-700 mb-1">Step 4: Total Score Calculation</h5>
                                                        <p class="text-sm text-gray-600 mb-2">Formula: <code>Total Score = ∑(Weighted Scores)</code></p>
                                                        <div class="bg-gray-50 p-3 rounded">
                                                            <p class="text-sm">Sum of all weighted scores: <span class="font-medium">{{ number_format($exampleIntern['total_score'], 4) }}</span></p>
                                                            <p class="text-xs text-gray-500">This represents the overall performance across all criteria.</p>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <h5 class="font-medium text-gray-700 mb-1">Step 5: Ranking</h5>
                                                        <p class="text-sm text-gray-600 mb-2">Sort interns by total score in descending order</p>
                                                        <div class="bg-gray-50 p-3 rounded">
                                                            <p class="text-sm">Rank for {{ $exampleIntern['pelamar_nama'] }}: <span class="font-medium">{{ $exampleIntern['rank'] }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div>
                                            <h4 class="font-medium text-indigo-800 mb-2">Weekly Progressive Weighting</h4>
                                            <p class="text-sm text-gray-700 mb-2">For final rankings across all weeks, the scores from later weeks are given more weight:</p>
                                            <div class="bg-white p-4 rounded-lg border border-indigo-100">
                                                <p class="text-sm mb-2"><code>Week Weight (wi) = i / ∑i</code> where i is the week number</p>
                                                <div class="grid grid-cols-1 md:grid-cols-{{ min($weekCount, 4) }} gap-2">
                                                    @for($i = 1; $i <= $weekCount; $i++)
                                                        <div class="bg-gray-50 p-2 rounded text-center">
                                                            <p class="text-sm font-medium">Week {{ $i }}</p>
                                                            <p class="text-sm">Weight: {{ number_format($i / array_sum(range(1, $weekCount)), 4) }}</p>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endfor
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for tabs -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.week-tab');
            const panels = document.querySelectorAll('.week-panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const week = tab.getAttribute('data-week');

                    // Hide all panels and remove active class from tabs
                    panels.forEach(panel => panel.classList.add('hidden'));
                    tabs.forEach(t => {
                        t.classList.remove('border-indigo-500', 'text-indigo-600');
                        t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    });

                    // Show selected panel and add active class to tab
                    document.getElementById(`week-panel-${week}`).classList.remove('hidden');
                    tab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    tab.classList.add('border-indigo-500', 'text-indigo-600');
                });
            });

            // Toggle methodology content
            for (let week = 1; week <= {{ $weekCount }}; week++) {
                const toggleBtn = document.getElementById(`toggle-methodology-${week}`);
                const methodologyContent = document.getElementById(`methodology-content-${week}`);

                if (toggleBtn && methodologyContent) {
                    toggleBtn.addEventListener('click', () => {
                        // Toggle visibility
                        if (methodologyContent.classList.contains('hidden')) {
                            methodologyContent.classList.remove('hidden');
                            toggleBtn.querySelector('span').textContent = 'Hide Calculation Steps';
                            toggleBtn.querySelector('svg').style.transform = 'rotate(180deg)';
                        } else {
                            methodologyContent.classList.add('hidden');
                            toggleBtn.querySelector('span').textContent = 'Show Calculation Steps';
                            toggleBtn.querySelector('svg').style.transform = 'rotate(0)';
                        }
                    });
                }
            }
        });
    </script>
</x-app-layout>
