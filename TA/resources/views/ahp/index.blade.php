<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-chart-line text-indigo-600 mr-2"></i> AHP Criteria Weighting for {{ $job->nama_job }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('criteria.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Criteria
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Introduction Card with enhanced design -->
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-8 mb-8 shadow-lg text-white transform transition-all duration-300 hover:shadow-xl">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-16 w-16 rounded-full bg-white/20 backdrop-blur flex items-center justify-center">
                                    <i class="fas fa-chart-line text-3xl text-white"></i>
                                </div>
                            </div>
                            <div class="ml-6 flex-1">
                                <h3 class="text-2xl font-bold mb-4">AHP Criteria Weighting Process</h3>
                                <p class="text-lg mb-6 opacity-90">
                                    Welcome to the Analytic Hierarchy Process (AHP) weighting system. This tool helps you determine the relative importance of different job criteria through pairwise comparisons.
                                </p>
                                <div class="flex items-center text-sm bg-white/10 backdrop-blur rounded-lg p-4">
                                    <i class="fas fa-info-circle text-xl mr-3"></i>
                                    <span class="font-medium">Follow the steps below to set up your criteria weights</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($hasCalculatedWeights)
                    <!-- Current Weights Display -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-lg shadow-sm mb-8 border border-green-100 transform transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center mb-6">
                            <div class="rounded-full h-10 w-10 flex items-center justify-center bg-green-100 text-green-600 mr-3">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-green-800">Current Criteria Weights</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($criteria as $criterion)
                            <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                <div class="flex justify-between items-center mb-3">
                                    <div>
                                        <span class="font-medium text-gray-700">{{ $criterion->name }}</span>
                                        <span class="text-xs text-gray-500 block">({{ $criterion->code }})</span>
                                    </div>
                                    <span class="text-lg font-bold text-green-600">{{ number_format($criterion->weight * 100, 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $criterion->weight * 100 }}%"></div>
                                </div>
                                <p class="text-xs text-gray-500">Weight: {{ number_format($criterion->weight, 4) }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- AHP Scale Guide -->
                    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-lg p-6 mb-8 shadow-sm border border-yellow-100 transform transition-all duration-300 hover:shadow-md">
                        <div class="flex items-center mb-6">
                            <div class="rounded-full h-10 w-10 flex items-center justify-center bg-yellow-100 text-yellow-600 mr-3">
                                <i class="fas fa-balance-scale text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-yellow-800">AHP Scale Guide</h3>
                        </div>
                        <p class="text-yellow-800 mb-6 text-sm">
                            When comparing criteria, use the scale below to indicate how much more important the row criterion is compared to the column criterion:
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @php
                                $scaleItems = [
                                    ['value' => '1', 'title' => 'Equal Importance', 'desc' => 'Criteria contribute equally', 'color' => 'green'],
                                    ['value' => '3', 'title' => 'Moderate Importance', 'desc' => 'Slight favor of one over another', 'color' => 'blue'],
                                    ['value' => '5', 'title' => 'Strong Importance', 'desc' => 'Strong favor of one over another', 'color' => 'indigo'],
                                    ['value' => '7', 'title' => 'Very Strong Importance', 'desc' => 'Very strong dominance', 'color' => 'purple'],
                                    ['value' => '9', 'title' => 'Extreme Importance', 'desc' => 'Highest possible dominance', 'color' => 'red'],
                                    ['value' => '2,4,6,8', 'title' => 'Intermediate Values', 'desc' => 'When compromise is needed', 'color' => 'gray']
                                ];
                            @endphp
                            @foreach($scaleItems as $item)
                            <div class="bg-white rounded-lg p-4 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                                <div class="flex items-center mb-2">
                                    <span class="w-12 h-12 flex items-center justify-center bg-{{ $item['color'] }}-100 rounded-full text-{{ $item['color'] }}-800 font-bold mr-3 text-lg">{{ $item['value'] }}</span>
                                    <span class="text-gray-700 font-medium">{{ $item['title'] }}</span>
                                </div>
                                <p class="text-sm text-gray-600 ml-15">{{ $item['desc'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('ahp.save-comparisons', $job->job_id) }}" method="POST">
                        @csrf
                        <!-- Comparison Matrix -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
                            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <div class="flex items-center">
                                    <i class="fas fa-table text-gray-600 mr-3 text-lg"></i>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Pairwise Comparison Matrix</h3>
                                        <p class="text-sm text-gray-600 mt-1">Compare the importance of each criterion against others</p>
                                    </div>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40 sticky left-0 bg-gradient-to-r from-gray-50 to-gray-100 z-10">
                                                <span class="flex items-center">
                                                    <i class="fas fa-list text-gray-400 mr-2"></i> Criteria
                                                </span>
                                            </th>
                                            @foreach($criteria as $criterion)
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex flex-col items-center">
                                                        <span class="mb-1 font-bold">{{ $criterion->code }}</span>
                                                        <span class="text-[10px] text-gray-400 font-normal">{{ Str::limit($criterion->name, 20) }}</span>
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
                                                        <span class="text-sm font-medium text-gray-900">{{ $rowCriterion->code }}</span>
                                                        <span class="text-xs text-gray-500">{{ Str::limit($rowCriterion->name, 25) }}</span>
                                                    </div>
                                                </td>

                                                @foreach($criteria as $colCriterion)
                                                    @if($rowCriterion->criteria_id == $colCriterion->criteria_id)
                                                        <td class="px-6 py-4 whitespace-nowrap text-center bg-gray-50">
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800">1</span>
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
                                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors duration-200">
                                                                <option value="">Select</option>
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
                                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600">
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
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
                            <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-200">
                                <div class="flex items-center">
                                    <i class="fas fa-info-circle text-blue-600 mr-3 text-lg"></i>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Criteria Reference</h3>
                                        <p class="text-sm text-gray-600 mt-1">Detailed information about each criterion</p>
                                    </div>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('criteria.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md hover:shadow-lg">
                                <i class="fas fa-calculator mr-2"></i> Calculate Weights
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>