<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                AHP Criteria Weighting for {{ $job->nama_job }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('criteria.index') }}" class="text-sm bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-md shadow-sm hover:from-blue-600 hover:to-blue-700 transition duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Criteria Management
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Introduction Card with enhanced design -->
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-8 mb-8 shadow-lg text-white">
                        <h3 class="text-2xl font-bold mb-4">AHP Criteria Weighting Process</h3>
                        <p class="text-lg mb-6 opacity-90">
                            Welcome to the Analytic Hierarchy Process (AHP) weighting system. This tool helps you determine the relative importance of different job criteria through pairwise comparisons.
                        </p>
                        <div class="flex items-center text-sm bg-white/10 rounded-lg p-4">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">Follow the steps below to set up your criteria weights</span>
                        </div>
                    </div>

                    @if($hasCalculatedWeights)
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-lg shadow-sm mb-8">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-green-800">Current Criteria Weights</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($criteria as $criterion)
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium text-gray-700">{{ $criterion->name }}</span>
                                    <span class="text-sm text-gray-500">({{ $criterion->code }})</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $criterion->weight * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-semibold text-green-700">{{ number_format($criterion->weight * 100, 2) }}%</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- AHP Scale Guide -->
                    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-lg p-6 mb-8 shadow-sm">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-yellow-800">AHP Scale Guide</h3>
                        </div>
                        <p class="text-yellow-800 mb-4">
                            When comparing criteria, use the scale below to indicate how much more important the row criterion is compared to the column criterion:
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <span class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-800 font-bold mr-2">1</span>
                                    <span class="text-gray-700">Equal Importance</span>
                                </div>
                                <p class="text-sm text-gray-600">Criteria contribute equally</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <span class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-800 font-bold mr-2">3</span>
                                    <span class="text-gray-700">Moderate Importance</span>
                                </div>
                                <p class="text-sm text-gray-600">Slight favor of one over another</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <span class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-800 font-bold mr-2">5</span>
                                    <span class="text-gray-700">Strong Importance</span>
                                </div>
                                <p class="text-sm text-gray-600">Strong favor of one over another</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <span class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-800 font-bold mr-2">7</span>
                                    <span class="text-gray-700">Very Strong Importance</span>
                                </div>
                                <p class="text-sm text-gray-600">Very strong dominance</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <span class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-800 font-bold mr-2">9</span>
                                    <span class="text-gray-700">Extreme Importance</span>
                                </div>
                                <p class="text-sm text-gray-600">Highest possible dominance</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                    <span class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-800 font-bold mr-2">2,4,6,8</span>
                                    <span class="text-gray-700">Intermediate Values</span>
                                </div>
                                <p class="text-sm text-gray-600">When compromise is needed</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('ahp.save-comparisons', $job->job_id) }}" method="POST">
                        @csrf
                        <!-- Comparison Matrix -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Pairwise Comparison Matrix</h3>
                                <p class="text-sm text-gray-600 mt-1">Compare the importance of each criterion against others</p>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Criteria</th>
                                            @foreach($criteria as $criterion)
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex flex-col items-center">
                                                        <span class="mb-1">{{ $criterion->code }}</span>
                                                        <span class="text-[10px] text-gray-400 font-normal">{{ $criterion->name }}</span>
                                                    </div>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $rowCriterion)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-gray-900">{{ $rowCriterion->code }}</span>
                                                        <span class="text-xs text-gray-500">{{ $rowCriterion->name }}</span>
                                                    </div>
                                                </td>

                                                @foreach($criteria as $colCriterion)
                                                    @if($rowCriterion->criteria_id == $colCriterion->criteria_id)
                                                        <td class="px-6 py-4 whitespace-nowrap text-center bg-gray-50">
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">1</span>
                                                            <input type="hidden" name="comparison[{{ $rowCriterion->criteria_id }}][{{ $colCriterion->criteria_id }}]" value="1">
                                                        </td>
                                                    @elseif($rowCriterion->code < $colCriterion->code)
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            @php
                                                                $key = $rowCriterion->criteria_id . '_' . $colCriterion->criteria_id;
                                                                $value = isset($comparisons[$key]) ? $comparisons[$key]->value : '';
                                                                if (!empty($value)) {
                                                                    $intValue = round(floatval($value));
                                                                } else {
                                                                    $intValue = '';
                                                                }
                                                            @endphp
                                                            <select name="comparison[{{ $rowCriterion->criteria_id }}][{{ $colCriterion->criteria_id }}]"
                                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                                <option value="">Select importance</option>
                                                                @for($i = 1; $i <= 9; $i++)
                                                                    <option value="{{ $i }}" {{ $intValue == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </td>
                                                    @else
                                                        <td class="px-6 py-4 whitespace-nowrap text-center bg-gray-50">
                                                            @php
                                                                $key = $colCriterion->criteria_id . '_' . $rowCriterion->criteria_id;
                                                            @endphp
                                                            @if(isset($comparisons[$key]) && $comparisons[$key]->value > 0)
                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                                                    1/{{ round(floatval($comparisons[$key]->value)) }}
                                                                </span>
                                                            @else
                                                                <span class="text-gray-400">-</span>
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Criteria Reference -->
                        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Criteria Reference</h3>
                                <p class="text-sm text-gray-600 mt-1">Detailed information about each criterion</p>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $criterion)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $criterion->code }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-900">{{ $criterion->name }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-700">{{ $criterion->description ?? 'No description available' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('criteria.index') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-blue-300 shadow-sm text-sm font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Criteria Management
                            </a>
                            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Calculate Weights
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
