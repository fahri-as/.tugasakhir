<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-chart-bar text-indigo-600 mr-2"></i> AHP Results for {{ $job->nama_job }}
            </h2>
            <nav class="flex">
                <a href="{{ route('ahp.index', $job->job_id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Comparison
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Results Header Card -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-8 mb-8 shadow-lg text-white transform transition-all duration-300 hover:shadow-xl">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-16 w-16 rounded-full bg-white/20 backdrop-blur flex items-center justify-center">
                                    <i class="fas fa-chart-bar text-3xl text-white"></i>
                                </div>
                            </div>
                            <div class="ml-6 flex-1">
                                <h3 class="text-2xl font-bold mb-4">AHP Calculation Results</h3>
                                <p class="text-lg mb-6 opacity-90">
                                    Your criteria weights have been successfully calculated using the Analytic Hierarchy Process.
                                    Below you'll find the detailed results and consistency analysis.
                                </p>
                                <div class="flex items-center text-sm bg-white/10 backdrop-blur rounded-lg p-4">
                                    <i class="fas fa-check-circle text-xl mr-3"></i>
                                    <span class="font-medium">Analysis completed successfully</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Consistency Check Card -->
                    <div class="mb-8">
                        @if($cr <= 0.1)
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-6 shadow-sm border border-green-200 transform transition-all duration-300 hover:shadow-md">
                                <div class="flex items-center mb-6">
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                                        <i class="fas fa-check-circle text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-green-800">Consistency Check Passed</h3>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                        <p class="text-sm text-gray-600 mb-1">Consistency Index (CI)</p>
                                        <p class="text-2xl font-bold text-green-700">{{ number_format($ci, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                        <p class="text-sm text-gray-600 mb-1">Random Index (RI)</p>
                                        <p class="text-2xl font-bold text-green-700">{{ number_format($ri, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                        <p class="text-sm text-gray-600 mb-1">Consistency Ratio (CR)</p>
                                        <p class="text-2xl font-bold text-green-700">{{ number_format($cr, 4) }}</p>
                                        <p class="text-xs text-green-600 mt-1">CR ≤ 0.1 ✓</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-lg p-6 shadow-sm border border-red-200 transform transition-all duration-300 hover:shadow-md">
                                <div class="flex items-center mb-6">
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-red-100 text-red-600 mr-4">
                                        <i class="fas fa-exclamation-circle text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-red-800">Consistency Check Failed</h3>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                        <p class="text-sm text-gray-600 mb-1">Consistency Index (CI)</p>
                                        <p class="text-2xl font-bold text-red-700">{{ number_format($ci, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                        <p class="text-sm text-gray-600 mb-1">Random Index (RI)</p>
                                        <p class="text-2xl font-bold text-red-700">{{ number_format($ri, 4) }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
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
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 shadow-sm mb-8 border border-blue-100 transform transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center mb-6">
                            <div class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-100 text-blue-600 mr-3">
                                <i class="fas fa-chart-pie text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Criteria Weight Distribution</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($criteria as $criterion)
                                <div class="bg-white rounded-lg p-5 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $criterion->code }}</h4>
                                            <p class="text-sm text-gray-600">{{ $criterion->name }}</p>
                                        </div>
                                        <span class="text-2xl font-bold text-blue-600">{{ number_format($criterion->weight * 100, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full transition-all duration-500 ease-out"
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
                                    <i class="fas fa-table text-gray-600 mr-3 text-lg"></i>
                                    <h3 class="text-lg font-semibold text-gray-800">1. Pairwise Comparison Matrix</h3>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gradient-to-r from-gray-50 to-gray-100 z-10">
                                                <span class="flex items-center">
                                                    <i class="fas fa-list text-gray-400 mr-2"></i> Criteria
                                                </span>
                                            </th>
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
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
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
                                        <tr class="bg-gradient-to-r from-gray-100 to-gray-50 font-bold">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 sticky left-0 bg-gradient-to-r from-gray-100 to-gray-50 z-10">
                                                <span class="flex items-center">
                                                    <i class="fas fa-calculator text-gray-500 mr-2"></i> Column Sum
                                                </span>
                                            </td>
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
                                    <i class="fas fa-percentage text-gray-600 mr-3 text-lg"></i>
                                    <h3 class="text-lg font-semibold text-gray-800">2. Normalized Matrix & Priority Vector</h3>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gradient-to-r from-gray-50 to-gray-100 z-10">
                                                <span class="flex items-center">
                                                    <i class="fas fa-list text-gray-400 mr-2"></i> Criteria
                                                </span>
                                            </th>
                                            @foreach($criteria as $criterion)
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $criterion->code }}</th>
                                            @endforeach
                                            <th class="px-6 py-3 text-center text-xs font-medium text-green-700 uppercase tracking-wider bg-gradient-to-r from-green-50 to-emerald-50">
                                                <span class="flex items-center justify-center">
                                                    <i class="fas fa-weight text-green-600 mr-2"></i> Priority Vector
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $rowCriterion)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
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
                                                <td class="px-6 py-4 whitespace-nowrap text-center bg-gradient-to-r from-green-50 to-emerald-50">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800">
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
                                    <i class="fas fa-info-circle text-yellow-600 mr-3 text-lg"></i>
                                    <h3 class="text-lg font-semibold text-gray-800">3. Criteria Reference Guide</h3>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-code text-gray-400 mr-2"></i> Code
                                                </span>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-tag text-gray-400 mr-2"></i> Name
                                                </span>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-align-left text-gray-400 mr-2"></i> Description
                                                </span>
                                            </th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center justify-center">
                                                    <i class="fas fa-percentage text-gray-400 mr-2"></i> Final Weight
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $criterion)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
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
                        <a href="{{ route('ahp.index', $job->job_id) }}" class="inline-flex items-center px-6 py-3 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Comparison Matrix
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>