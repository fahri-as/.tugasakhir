<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                AHP Results for {{ $job->nama_job }}
            </h2>
            <nav class="flex">
                <a href="{{ route('ahp.index', $job->job_id) }}" class="text-sm bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-md shadow-sm hover:from-gray-600 hover:to-gray-700 transition duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Comparison
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Results Header Card -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-8 mb-8 shadow-lg text-white">
                        <h3 class="text-2xl font-bold mb-4">AHP Calculation Results</h3>
                        <p class="text-lg mb-6 opacity-90">
                            Your criteria weights have been successfully calculated using the Analytic Hierarchy Process.
                            Below you'll find the detailed results and consistency analysis.
                        </p>
                        <div class="flex items-center text-sm bg-white/10 rounded-lg p-4">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium">Analysis completed successfully</span>
                        </div>
                    </div>

                    <!-- Consistency Check Card -->
                    <div class="mb-8">
                        @if($cr <= 0.1)
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-6 shadow-sm border border-green-200">
                                <div class="flex items-center mb-4">
                                    <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h3 class="text-xl font-bold text-green-800">Consistency Check Passed</h3>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Consistency Index (CI)</p>
                                        <p class="text-2xl font-bold text-green-700">{{ number_format($ci, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Random Index (RI)</p>
                                        <p class="text-2xl font-bold text-green-700">{{ number_format($ri, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Consistency Ratio (CR)</p>
                                        <p class="text-2xl font-bold text-green-700">{{ number_format($cr, 4) }}</p>
                                        <p class="text-xs text-green-600 mt-1">CR ≤ 0.1 ✓</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-lg p-6 shadow-sm border border-red-200">
                                <div class="flex items-center mb-4">
                                    <svg class="w-8 h-8 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h3 class="text-xl font-bold text-red-800">Consistency Check Failed</h3>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Consistency Index (CI)</p>
                                        <p class="text-2xl font-bold text-red-700">{{ number_format($ci, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Random Index (RI)</p>
                                        <p class="text-2xl font-bold text-red-700">{{ number_format($ri, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <p class="text-sm text-gray-600 mb-1">Consistency Ratio (CR)</p>
                                        <p class="text-2xl font-bold text-red-700">{{ number_format($cr, 4) }}</p>
                                        <p class="text-xs text-red-600 mt-1">CR > 0.1 ✗</p>
                                    </div>
                                </div>
                                <div class="mt-4 bg-white rounded-lg p-4">
                                    <p class="text-sm text-red-700">
                                        <strong>Recommendation:</strong> Please review and adjust your pairwise comparisons to improve consistency.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Criteria Weights Visualization -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 shadow-sm mb-8">
                        <div class="flex items-center mb-6">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-800">Criteria Weight Distribution</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($criteria as $criterion)
                                <div class="bg-white rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $criterion->code }}</h4>
                                            <p class="text-sm text-gray-600">{{ $criterion->name }}</p>
                                        </div>
                                        <span class="text-2xl font-bold text-blue-600">{{ number_format($criterion->weight * 100, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-500 ease-out"
                                             style="width: {{ $criterion->weight * 100 }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500">Weight: {{ number_format($criterion->weight, 4) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Detailed Results Tables -->
                    <div class="space-y-8">
                        <!-- Pairwise Comparison Matrix -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800">1. Pairwise Comparison Matrix</h3>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-10">Criteria</th>
                                            @foreach($criteria as $criterion)
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex flex-col items-center">
                                                        <span class="font-bold">{{ $criterion->code }}</span>
                                                        <span class="text-[10px] text-gray-400 font-normal">{{ Str::limit($criterion->name, 15) }}</span>
                                                    </div>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $rowCriterion)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap sticky left-0 bg-white z-10">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm font-bold text-gray-900">{{ $rowCriterion->code }}</span>
                                                        <span class="text-xs text-gray-500">{{ Str::limit($rowCriterion->name, 20) }}</span>
                                                    </div>
                                                </td>
                                                @foreach($criteria as $colCriterion)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center {{ $rowCriterion->criteria_id == $colCriterion->criteria_id ? 'bg-gray-50' : '' }}">
                                                        <span class="{{ $rowCriterion->criteria_id == $colCriterion->criteria_id ? 'font-bold text-gray-700' : 'text-gray-600' }}">
                                                            {{ number_format($matrix[$rowCriterion->criteria_id][$colCriterion->criteria_id], 3) }}
                                                        </span>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr class="bg-gray-100 font-bold">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 sticky left-0 bg-gray-100 z-10">Column Sum</td>
                                            @foreach($criteria as $colCriterion)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                                    {{ number_format($colSums[$colCriterion->criteria_id], 3) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Normalized Matrix -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800">2. Normalized Matrix & Priority Vector</h3>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-10">Criteria</th>
                                            @foreach($criteria as $criterion)
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $criterion->code }}</th>
                                            @endforeach
                                            <th class="px-6 py-3 text-center text-xs font-medium text-green-700 uppercase tracking-wider bg-green-50">Priority Vector</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $rowCriterion)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap sticky left-0 bg-white z-10">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm font-bold text-gray-900">{{ $rowCriterion->code }}</span>
                                                        <span class="text-xs text-gray-500">{{ Str::limit($rowCriterion->name, 20) }}</span>
                                                    </div>
                                                </td>
                                                @foreach($criteria as $colCriterion)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600">
                                                        {{ number_format($normalizedMatrix[$rowCriterion->criteria_id][$colCriterion->criteria_id], 4) }}
                                                    </td>
                                                @endforeach
                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-green-50">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                                                        {{ number_format($rowCriterion->weight, 4) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Criteria Reference -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 bg-gradient-to-r from-yellow-50 to-amber-50 border-b border-yellow-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800">3. Criteria Reference Guide</h3>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Final Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $criterion)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $criterion->code }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $criterion->name }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-600">{{ $criterion->description ?? 'No description available' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800">
                                                        {{ number_format($criterion->weight * 100, 2) }}%
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex justify-center">
                        <a href="{{ route('ahp.index', $job->job_id) }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Comparison Matrix
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>