<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mx-auto">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-2xl font-semibold text-gray-800">Evaluation Details</h1>
                            <div class="flex space-x-2">
                                <a href="{{ route('evaluasi.edit', $evaluasi) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <a href="{{ route('evaluasi.index', ['periode_id' => $evaluasi->magang->pelamar->periode_id ?? '']) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                                    Back to List
                                </a>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Evaluation Information -->
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-2 border-b">
                                    <h2 class="font-semibold text-lg">Evaluation Information</h2>
                                </div>
                                <div class="p-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Evaluation ID</p>
                                            <p class="font-medium">{{ $evaluasi->evaluasi_id }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Week</p>
                                            <p class="font-medium">Week {{ $evaluasi->minggu_ke }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Rating</p>
                                            <p class="font-medium">
                                                @if($evaluasi->criteria_rating_id)
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                                    {{ $evaluasi->criteriaRatingScale->name ?? 'N/A' }}
                                                </span>
                                                @else
                                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">
                                                    Not Rated Yet
                                                </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Score (0-5 scale)</p>
                                            <p class="font-medium">{{ $evaluasi->criteria_rating_id ? number_format($evaluasi->skor_minggu * 10, 0) : 'N/A' }}</p>
                                        </div>
                                        <div class="col-span-2">
                                            <p class="text-sm text-gray-600">Criteria</p>
                                            <p class="font-medium">
                                                @if($evaluasi->criteria)
                                                    {{ $evaluasi->criteria->name }} ({{ $evaluasi->criteria->code }})
                                                    <br>
                                                    <span class="text-sm text-gray-500">{{ $evaluasi->criteria->description }}</span>
                                                @else
                                                    <span class="text-gray-500 italic">No specific criteria</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Intern Information -->
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-2 border-b">
                                    <h2 class="font-semibold text-lg">Intern Information</h2>
                                </div>
                                <div class="p-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Intern ID</p>
                                            <p class="font-medium">{{ $evaluasi->magang->magang_id }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Name</p>
                                            <p class="font-medium">{{ $evaluasi->magang->pelamar->nama }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Position</p>
                                            <p class="font-medium">
                                                {{ $evaluasi->magang->pelamar->job->nama_job ?? 'Not assigned' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Status</p>
                                            <p class="font-medium">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $evaluasi->magang->status_seleksi === 'Sedang Berjalan' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $evaluasi->magang->status_seleksi === 'Lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ $evaluasi->magang->status_seleksi === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : '' }}
                                                    {{ $evaluasi->magang->status_seleksi === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                                    {{ $evaluasi->magang->status_seleksi }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-span-2">
                                            <a href="{{ route('magang.show', $evaluasi->magang) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                View Full Intern Details →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SMART Analysis (Only for Cook and Pastry Chef) -->
                        @if($evaluasi->magang &&
                            $evaluasi->magang->pelamar &&
                            $evaluasi->magang->pelamar->job_id &&
                            in_array($evaluasi->magang->pelamar->job_id, ['JOB001', 'JOB004']) &&
                            $smartDetails)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                            <div class="bg-indigo-50 px-6 py-4 border-b">
                                <h2 class="font-semibold text-lg text-indigo-900">SMART Analysis</h2>
                                <p class="text-xs text-indigo-700">
                                    Simple Multi-Attribute Rating Technique for Cook and Pastry Chef positions
                                </p>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <h3 class="text-md font-medium text-gray-700">Week {{ $evaluasi->minggu_ke }} Ranking</h3>
                                        <p class="text-sm text-gray-500">SMART method-based performance ranking</p>
                                    </div>
                                    <div class="bg-indigo-100 text-indigo-800 font-semibold px-4 py-2 rounded-lg">
                                        Rank: {{ $smartDetails['rank'] }}
                                        (Score: {{ number_format($smartDetails['total_score'], 4) }})
                                    </div>
                                </div>

                                <!-- SMART Calculation Table -->
                                <div class="overflow-x-auto bg-white rounded-lg border">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Raw Score</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Normalized (0-1)</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weighted Score</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($smartDetails['score_details'] as $detail)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $detail['criteria_name'] }} ({{ $detail['criteria_code'] }})
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ number_format($detail['weight'], 4) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ number_format($detail['raw_value'], 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ number_format($detail['normalized_value'], 4) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ number_format($detail['weighted_score'], 4) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr class="bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" colspan="4">
                                                    Total Score
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ number_format($smartDetails['total_score'], 4) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- SMART Calculation Steps/Explanation -->
                                <div class="mt-6 bg-indigo-50 p-6 rounded-lg">
                                    <h3 class="text-lg font-semibold text-indigo-900 mb-3">SMART Calculation Methodology</h3>

                                    <div class="space-y-4">
                                        <div>
                                            <h4 class="font-medium text-indigo-800">Step 1: Data Collection</h4>
                                            <p class="text-sm text-gray-700 mb-2">Raw scores from evaluations are collected for each criterion.</p>
                                            <div class="bg-white p-3 rounded border border-indigo-100">
                                                <h5 class="text-sm font-semibold mb-2">Actual Raw Scores for {{ $evaluasi->magang->pelamar->nama }}</h5>
                                                @if($actualCalculation && $actualCalculation['has_data'])
                                                    <div class="overflow-x-auto">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Criteria</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Raw Score</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Weight</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="bg-white divide-y divide-gray-200">
                                                                @foreach($actualCalculation['criteria'] as $criterion)
                                                                <tr>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['criteria_name'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['criteria_code'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['raw_score'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ number_format($criterion['weight'], 4) }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p class="text-sm text-gray-500">No calculation data available.</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="font-medium text-indigo-800">Step 2: Normalization (Utility Value)</h4>
                                            <p class="text-sm text-gray-700 mb-2">Each raw score is normalized to a 0-1 scale:</p>
                                            <div class="bg-white p-3 rounded border border-indigo-100">
                                                <code class="text-sm">Normalized Value = (Raw Value - Min Value) / (Max Value - Min Value)</code>
                                                @if($actualCalculation && $actualCalculation['has_data'])
                                                    <div class="overflow-x-auto mt-2">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Criteria</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Raw Score</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Min Value</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Max Value</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Calculation</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Normalized</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="bg-white divide-y divide-gray-200">
                                                                @foreach($actualCalculation['criteria'] as $criterion)
                                                                <tr>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['criteria_code'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['raw_score'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['min_value'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['max_value'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['calculation'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ number_format($criterion['normalized'], 4) }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="font-medium text-indigo-800">Step 3: Weighted Score Calculation</h4>
                                            <p class="text-sm text-gray-700 mb-2">Utility values are multiplied by criterion weights:</p>
                                            <div class="bg-white p-3 rounded border border-indigo-100">
                                                <code class="text-sm">Weighted Score = Normalized Value × Criterion Weight</code>
                                                @if($actualCalculation && $actualCalculation['has_data'])
                                                    <div class="overflow-x-auto mt-2">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Criteria</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Normalized Value</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Weight</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Calculation</th>
                                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Weighted Score</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="bg-white divide-y divide-gray-200">
                                                                @foreach($actualCalculation['criteria'] as $criterion)
                                                                <tr>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['criteria_code'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ number_format($criterion['normalized'], 4) }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ number_format($criterion['weight'], 4) }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ $criterion['weighted_calculation'] }}</td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-900">{{ number_format($criterion['weighted'], 4) }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="font-medium text-indigo-800">Step 4: Total Weekly Score</h4>
                                            <p class="text-sm text-gray-700 mb-2">The sum of all weighted scores for the week:</p>
                                            <div class="bg-white p-3 rounded border border-indigo-100">
                                                <code class="text-sm">Total Weekly Score = ∑(Weighted Scores)</code>
                                                @if($actualCalculation && $actualCalculation['has_data'])
                                                    <div class="mt-2 text-sm">
                                                        <p class="font-medium">Calculation: {{ $actualCalculation['full_calculation'] }}</p>
                                                        <p class="font-medium mt-1">Total SMART Score (0-1 scale): {{ number_format($actualCalculation['total_score'], 4) }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="font-medium text-indigo-800">Step 5: Storage and Scaling</h4>
                                            <p class="text-sm text-gray-700 mb-2">The weekly total score is stored and can be scaled to a 0-5 range:</p>
                                            <div class="bg-white p-3 rounded border border-indigo-100">
                                                @if($actualCalculation && $actualCalculation['has_data'])
                                                    <div class="text-sm">
                                                        <p class="font-medium">Stored in Database:
                                                            <code>total_skor_minggu_magang(magang_id='{{ $evaluasi->magang_id }}', minggu_ke={{ $evaluasi->minggu_ke }}, total_skor={{ number_format($actualCalculation['total_score'], 4) }})</code>
                                                        </p>
                                                        <p class="font-medium mt-1">Scaled Score (0-5 range): {{ number_format($actualCalculation['total_score'] * 5, 2) }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    <!-- Weight Explanation -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="font-medium mb-2">Criteria Weights</h4>
                                        <p class="text-sm text-gray-600">
                                            Weights are calculated using AHP (Analytic Hierarchy Process) method through pairwise comparisons.
                                            Higher weights indicate more important criteria.
                                        </p>
                                    </div>

                                    <!-- Normalization Explanation -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="font-medium mb-2">Normalization</h4>
                                        <p class="text-sm text-gray-600">
                                            Raw scores are normalized to a 0-1 scale based on min-max values across all interns for the same criteria.
                                            This allows for fair comparison between different criteria.
                                        </p>
                                    </div>

                                    <!-- Weighted Score Explanation -->
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="font-medium mb-2">Weighted Scores</h4>
                                        <p class="text-sm text-gray-600">
                                            Normalized scores are multiplied by criteria weights to get weighted scores.
                                            The sum of all weighted scores determines the final ranking for each intern.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Criteria Contribution Chart -->
                        @if($criteriaContribution && count($criteriaContribution) > 0)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                            <div class="bg-gray-50 px-4 py-2 border-b">
                                <h2 class="font-semibold text-lg">Criteria Contribution Analysis</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($criteriaContribution as $contribution)
                                    <div class="bg-white border rounded-lg p-4 shadow-sm">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-medium">{{ $contribution['name'] }}</h3>
                                                <p class="text-sm text-gray-500">{{ $contribution['code'] }}</p>
                                            </div>
                                            <div class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                                Weight: {{ number_format($contribution['weight'], 4) }}
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $contribution['percentage'] }}%"></div>
                                            </div>
                                            <div class="flex justify-between mt-1 text-xs text-gray-600">
                                                <span>Contribution: {{ number_format($contribution['total_contribution'], 4) }}</span>
                                                <span>{{ number_format($contribution['percentage'], 1) }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="mt-4 text-sm text-gray-600">
                                    <p>This chart shows how much each criterion contributes to the intern's overall SMART score. Higher percentages indicate criteria that have more influence on the final ranking.</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex space-x-4">
                            <a href="{{ route('evaluasi.edit', $evaluasi) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Edit Evaluation
                            </a>

                            <form action="{{ route('evaluasi.destroy', $evaluasi) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this evaluation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete Evaluation
                                </button>
                            </form>

                            <a href="{{ route('magang.show', $evaluasi->magang) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View All Intern Evaluations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX Refresh for SMART Analysis -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set up auto-refresh for SMART analysis
            const csrfToken = '{{ csrf_token() }}';
            const evaluasiId = '{{ $evaluasi->evaluasi_id }}';
            const magangId = '{{ $evaluasi->magang_id }}';
            const weekNumber = {{ $evaluasi->minggu_ke }};

            // Function to refresh SMART data
            function refreshSmartData() {
                // Show loading indicator
                const smartContainer = document.querySelector('.bg-indigo-50');
                if (smartContainer) {
                    // Add loading indicator if it doesn't exist
                    let loadingIndicator = document.getElementById('smart-loading-indicator');
                    if (!loadingIndicator) {
                        loadingIndicator = document.createElement('div');
                        loadingIndicator.id = 'smart-loading-indicator';
                        loadingIndicator.className = 'text-xs text-indigo-600 ml-2';
                        loadingIndicator.textContent = 'Refreshing...';
                        smartContainer.appendChild(loadingIndicator);
                    } else {
                        loadingIndicator.textContent = 'Refreshing...';
                        loadingIndicator.classList.remove('hidden');
                    }
                }

                // Make AJAX request to get updated data
                fetch(`/api/evaluations?magang_id=${magangId}&week=${weekNumber}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Check if we got valid data
                    if (data && data.evaluations && data.evaluations.length > 0) {
                        // Refresh the page to show updated SMART analysis
                        // In a more advanced implementation, we would update just the SMART analysis section
                        // without reloading the page, but for simplicity we'll just reload the page
                        location.reload();
                    } else {
                        hideLoadingIndicator();
                        console.error('No evaluation data received');
                    }
                })
                .catch(error => {
                    hideLoadingIndicator();
                    console.error('Error refreshing SMART data:', error);
                });
            }

            function hideLoadingIndicator() {
                const loadingIndicator = document.getElementById('smart-loading-indicator');
                if (loadingIndicator) {
                    loadingIndicator.classList.add('hidden');
                }
            }

            // Set up refresh button
            const actionButtons = document.querySelectorAll('.flex.space-x-4');
            if (actionButtons.length > 0) {
                const refreshButton = document.createElement('button');
                refreshButton.className = 'bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded';
                refreshButton.textContent = 'Refresh SMART Analysis';
                refreshButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    refreshSmartData();
                });

                actionButtons[0].appendChild(refreshButton);
            }

            // Auto-refresh when the page loads (only if smart analysis exists)
            if (document.querySelector('.bg-indigo-50')) {
                refreshSmartData();
            }

            // Set up polling every 30 seconds
            setInterval(refreshSmartData, 30000);
        });
    </script>
</x-app-layout>
