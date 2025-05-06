<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            AHP Criteria Weighting for {{ $job->nama_job }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mb-6">
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            This page allows you to set the relative importance of job criteria using the Analytic Hierarchy Process (AHP) method.
                            Complete the pairwise comparison matrix below by selecting the relative importance of each criterion compared to others.
                        </p>

                        @if($hasCalculatedWeights)
                            <div class="bg-green-100 dark:bg-green-800 p-4 rounded-md mb-6">
                                <h3 class="font-semibold text-green-800 dark:text-green-200 mb-2">Current Criteria Weights</h3>
                                <ul class="list-disc list-inside">
                                    @foreach($criteria as $criterion)
                                        <li class="text-green-700 dark:text-green-300">
                                            {{ $criterion->name }} ({{ $criterion->code }}): {{ number_format($criterion->weight * 100, 2) }}%
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4">
                                    <a href="{{ route('smart.index', $job->job_id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                        Proceed to SMART Ranking
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="bg-yellow-50 dark:bg-yellow-900 p-4 rounded-md mb-6">
                            <h3 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-2">How to use the AHP Scale</h3>
                            <p class="text-yellow-700 dark:text-yellow-300 mb-2">
                                Compare the row criterion to the column criterion:
                            </p>
                            <ul class="list-disc list-inside text-yellow-700 dark:text-yellow-300">
                                <li>1: Equal importance</li>
                                <li>3: Moderate importance</li>
                                <li>5: Strong importance</li>
                                <li>7: Very strong importance</li>
                                <li>9: Extreme importance</li>
                                <li>2, 4, 6, 8: Intermediate values</li>
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('ahp.save-comparisons', $job->job_id) }}" method="POST">
                        @csrf

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Criteria</th>
                                        @foreach($criteria as $criterion)
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                {{ $criterion->code }}: {{ $criterion->name }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($criteria as $rowCriterion)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                                {{ $rowCriterion->code }}: {{ $rowCriterion->name }}
                                            </td>

                                            @foreach($criteria as $colCriterion)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    @if($rowCriterion->criteria_id == $colCriterion->criteria_id)
                                                        <span class="font-bold">1</span>
                                                        <input type="hidden" name="comparison[{{ $rowCriterion->criteria_id }}][{{ $colCriterion->criteria_id }}]" value="1">
                                                    @else
                                                        @php
                                                            $key = $rowCriterion->criteria_id . '_' . $colCriterion->criteria_id;
                                                            $value = isset($comparisons[$key]) ? $comparisons[$key]->value : '';
                                                        @endphp
                                                        <select name="comparison[{{ $rowCriterion->criteria_id }}][{{ $colCriterion->criteria_id }}]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                            <option value="">Select</option>
                                                            @for($i = 1; $i <= 9; $i++)
                                                                <option value="{{ $i }}" {{ $value == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Calculate Weights
                            </button>

                            <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
