<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            AHP Criteria Weighting for {{ $job->nama_job }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <p class="text-gray-700 mb-4">
                            This page allows you to set the relative importance of job criteria using the Analytic Hierarchy Process (AHP) method.
                            Complete the pairwise comparison matrix below by selecting the relative importance of each criterion compared to others.
                        </p>

                        @if($hasCalculatedWeights)
                            <div class="bg-green-50 p-4 rounded-md mb-6">
                                <h3 class="font-semibold text-green-800 mb-2">Current Criteria Weights</h3>
                                <ul class="list-disc list-inside">
                                    @foreach($criteria as $criterion)
                                        <li class="text-green-700">
                                            {{ $criterion->name }} ({{ $criterion->code }}): {{ number_format($criterion->weight * 100, 2) }}%
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4">
                                    <a href="{{ route('smart.index', $job->job_id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Proceed to SMART Ranking
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="bg-yellow-50 p-4 rounded-md mb-6">
                            <h3 class="font-semibold text-yellow-800 mb-2">How to use the AHP Scale</h3>
                            <p class="text-yellow-700 mb-2">
                                Compare the row criterion to the column criterion:
                            </p>
                            <ul class="list-disc list-inside text-yellow-700">
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
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        @foreach($criteria as $criterion)
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ $criterion->code }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($criteria as $rowCriterion)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $rowCriterion->code }}
                                            </td>

                                            @foreach($criteria as $colCriterion)
                                                @if($rowCriterion->criteria_id == $colCriterion->criteria_id)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center bg-gray-50 font-bold">
                                                        1
                                                        <input type="hidden" name="comparison[{{ $rowCriterion->criteria_id }}][{{ $colCriterion->criteria_id }}]" value="1">
                                                    </td>
                                                @elseif($rowCriterion->code < $colCriterion->code)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        @php
                                                            // Use underscore key format to match the database key format
                                                            $key = $rowCriterion->criteria_id . '_' . $colCriterion->criteria_id;
                                                            $value = isset($comparisons[$key]) ? $comparisons[$key]->value : '';
                                                        @endphp
                                                        <select name="comparison[{{ $rowCriterion->criteria_id }}][{{ $colCriterion->criteria_id }}]" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm appearance-none bg-white">
                                                            <option value="">Select</option>
                                                            @for($i = 1; $i <= 9; $i++)
                                                                <option value="{{ $i }}" {{ $value == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </td>
                                                @else
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                        @php
                                                            // Use underscore key format to match the database key format
                                                            $key = $colCriterion->criteria_id . '_' . $rowCriterion->criteria_id;
                                                        @endphp
                                                        @if(isset($comparisons[$key]))
                                                            1/{{ $comparisons[$key]->value }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            <div class="bg-blue-50 p-4 rounded-md mb-6">
                                <h3 class="text-lg font-semibold text-blue-800 mb-2">Criteria Reference</h3>
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
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $criterion->code }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        {{ $criterion->name }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        {{ $criterion->description ?? 'No description available' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                                Calculate Weights
                            </button>

                            <a href="{{ route('dashboard') }}" class="text-white bg-gray-600 hover:bg-gray-700 font-bold py-2 px-4 rounded">
                                Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
