<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            AHP Results for {{ $job->nama_job }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Criteria Weights</h3>
                            <div class="flex gap-2">
                                <a href="{{ route('ahp.index', $job->job_id) }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">
                                    Back to Comparison Matrix
                                </a>
                                <a href="{{ route('smart.index', $job->job_id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                                    Proceed to SMART Ranking
                                </a>
                            </div>
                        </div>

                        <div class="bg-green-50 p-4 rounded-md mb-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-green-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Code</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Weight</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria as $criterion)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $criterion->code }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $criterion->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($criterion->weight, 4) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($criterion->weight * 100, 2) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Weight Visualization -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Weight Visualization</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($criteria as $criterion)
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h4 class="font-medium text-gray-800 mb-2">{{ $criterion->code }} - {{ $criterion->name }}</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-4">
                                            <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $criterion->weight * 100 }}%"></div>
                                        </div>
                                        <p class="text-gray-600 text-sm mt-1 text-right">{{ number_format($criterion->weight * 100, 2) }}%</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Consistency Information -->
                        <div class="bg-blue-50 p-4 rounded-md mb-6">
                            <h3 class="font-semibold text-blue-800 mb-2">Consistency Check</h3>
                            <p class="text-blue-700 mb-1"><strong>Consistency Index (CI):</strong> {{ number_format($ci, 4) }}</p>
                            <p class="text-blue-700 mb-1"><strong>Random Index (RI):</strong> {{ number_format($ri, 4) }}</p>
                            <p class="text-blue-700">
                                <strong>Consistency Ratio (CR):</strong> {{ number_format($cr, 4) }}
                                @if($cr <= 0.1)
                                    <span class="text-green-600 ml-2">(Consistent: CR ≤ 0.1)</span>
                                @else
                                    <span class="text-red-600 ml-2">(Inconsistent: CR > 0.1)</span>
                                @endif
                            </p>
                        </div>

                        <!-- AHP Calculation Details -->
                        <div class="border border-gray-200 rounded-md">
                            <div class="bg-gray-50 p-4 border-b border-gray-200">
                                <h3 class="font-semibold text-gray-800">AHP Calculation Details</h3>
                            </div>
                            <div class="p-4">
                                <h4 class="font-medium text-gray-800 mb-2">1. Pairwise Comparison Matrix</h4>
                                <div class="overflow-x-auto mb-6">
                                    <table class="min-w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                                @foreach($criteria as $criterion)
                                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $criterion->code }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($criteria as $rowCriterion)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $rowCriterion->code }}</td>
                                                    @foreach($criteria as $colCriterion)
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                            {{ number_format($matrix[$rowCriterion->criteria_id][$colCriterion->criteria_id], 3) }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            <tr class="bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Sum</td>
                                                @foreach($criteria as $colCriterion)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 font-medium">
                                                        {{ number_format($colSums[$colCriterion->criteria_id], 3) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="font-medium text-gray-800 mb-2">2. Normalized Matrix</h4>
                                <div class="overflow-x-auto mb-6">
                                    <table class="min-w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                                @foreach($criteria as $criterion)
                                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $criterion->code }}</th>
                                                @endforeach
                                                <th class="px-6 py-3 text-center text-xs font-medium text-green-700 uppercase tracking-wider bg-green-50">Priority Vector</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($criteria as $rowCriterion)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $rowCriterion->code }}</td>
                                                    @foreach($criteria as $colCriterion)
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                            {{ number_format($normalizedMatrix[$rowCriterion->criteria_id][$colCriterion->criteria_id], 4) }}
                                                        </td>
                                                    @endforeach
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-green-700 bg-green-50">
                                                        {{ number_format($rowCriterion->weight, 4) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="font-medium text-gray-800 mb-2">3. Criteria Explanation</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($criteria as $criterion)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $criterion->code }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $criterion->name }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $criterion->description ?? 'No description available' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
