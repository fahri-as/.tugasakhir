<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SMART Weekly Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Selection Form -->
                    <form action="{{ route('smart.evaluasi') }}" method="GET" class="mb-8">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div>
                                <label for="job_id" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                                <select id="job_id" name="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Select Position</option>
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->job_id }}" {{ $selectedJobId == $job->job_id ? 'selected' : '' }}>
                                            {{ $job->nama_job }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="periode_id" class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                                <select id="periode_id" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All Periods</option>
                                    @foreach($periodes as $periode)
                                        <option value="{{ $periode->periode_id }}" {{ $selectedPeriodeId == $periode->periode_id ? 'selected' : '' }}>
                                            {{ $periode->nama_periode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="week" class="block text-sm font-medium text-gray-700 mb-1">Week</label>
                                <select id="week" name="week" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @for($i = 1; $i <= ($maxWeek ?? 4); $i++)
                                        <option value="{{ $i }}" {{ $selectedWeek == $i ? 'selected' : '' }}>
                                            Week {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="flex items-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Criteria Weights Section -->
                    @if($selectedJobId && $criteria->isNotEmpty())
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Criteria Weights (AHP Method)</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria Code</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria Name</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $criterium)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $criterium->code }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $criterium->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ number_format($criterium->weight, 4) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('smart.criteria', $selectedJobId) }}" class="text-blue-600 hover:text-blue-900">
                                    View/Update Criteria Weights
                                </a>
                            </div>
                        </div>
                    @elseif($selectedJobId && $criteria->isEmpty())
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-8" role="alert">
                            <span class="block sm:inline">No criteria found for this position. Please add criteria and their weights first.</span>
                        </div>
                    @endif

                    <!-- Rankings Section -->
                    @if($selectedJobId && !empty($smartRankings))
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-medium text-gray-900">SMART Evaluation Rankings for Week {{ $selectedWeek }}</h3>

                                <a href="{{ route('smart.rankings', $selectedJobId) }}?periode_id={{ $selectedPeriodeId }}"
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    View Overall Rankings
                                </a>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SMART Score</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($smartRankings as $ranking)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $ranking['rank'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ranking['nama'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ranking['job'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ number_format($ranking['total_score'], 4) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="#" class="text-blue-600 hover:text-blue-900"
                                                       onclick="showDetails('{{ $ranking['magang_id'] }}', '{{ $ranking['nama'] }}'); return false;">
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Details Modal -->
                        <div id="details-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-4/5 shadow-lg rounded-md bg-white">
                                <div class="flex justify-between items-center pb-3">
                                    <h3 class="text-xl font-medium text-gray-900" id="details-title">Evaluation Details</h3>
                                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div id="details-content" class="overflow-x-auto">
                                    <!-- Content will be loaded dynamically -->
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <button type="button" class="inline-flex justify-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none" onclick="closeModal()">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    @elseif($selectedJobId && empty($smartRankings))
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">No evaluation data found for the selected position and week.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Store all rankings data for modal display
        const rankingsData = @json($smartRankings);

        function showDetails(magangId, internName) {
            // Find the specific intern data
            const internData = rankingsData.find(r => r.magang_id === magangId);

            if (!internData) return;

            // Update modal title
            document.getElementById('details-title').textContent = `Evaluation Details for ${internName}`;

            // Generate table with detailed evaluation data
            let tableHtml = `
                <table class="min-w-full divide-y divide-gray-200 mb-4">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Raw Value</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Normalized Value</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weighted Value</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
            `;

            // Add rows for each evaluation detail
            internData.evaluation_details.forEach(detail => {
                tableHtml += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${detail.criteria_name} (${detail.criteria_code})</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${detail.criteria_weight.toFixed(4)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${detail.raw_value.toFixed(2)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${detail.normalized_value.toFixed(4)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${detail.weighted_value.toFixed(4)}</td>
                    </tr>
                `;
            });

            // Add total row
            tableHtml += `
                    <tr class="bg-gray-50">
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">Total SMART Score:</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${internData.total_score.toFixed(4)}</td>
                    </tr>
                </tbody>
            </table>

            <div class="bg-gray-50 p-4 rounded-md">
                <h4 class="text-sm font-medium text-gray-700 mb-2">SMART Method Formula:</h4>
                <p class="text-sm text-gray-600">
                    1. Normalization: (Value - Min) / (Max - Min)<br>
                    2. Weighted Value: Normalized Value × Criteria Weight<br>
                    3. Total Score: Sum of all Weighted Values
                </p>
            </div>
            `;

            // Update modal content
            document.getElementById('details-content').innerHTML = tableHtml;

            // Show modal
            document.getElementById('details-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('details-modal').classList.add('hidden');
        }
    </script>
</x-app-layout>
