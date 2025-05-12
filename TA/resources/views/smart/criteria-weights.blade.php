<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Criteria Weights') }} - {{ $job->nama_job }}
            </h2>
            <a href="{{ route('smart.evaluasi') }}?job_id={{ $job->job_id }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back to SMART Evaluation
            </a>
        </div>
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

                    <!-- Information about AHP -->
                    <div class="bg-gray-50 p-4 rounded-md mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">About AHP Method</h3>
                        <p class="text-sm text-gray-600 mb-2">
                            The Analytic Hierarchy Process (AHP) is a structured method for organizing and analyzing complex decisions.
                            It helps determine the weights of different criteria based on pairwise comparisons.
                        </p>
                        <p class="text-sm text-gray-600">
                            Steps in AHP:
                            <ol class="list-decimal list-inside ml-4 text-sm text-gray-600">
                                <li>Create a pairwise comparison matrix</li>
                                <li>Normalize the matrix by dividing each value by its column sum</li>
                                <li>Calculate criteria weights as averages of normalized rows</li>
                                <li>Check consistency ratio (CR should be < 0.1)</li>
                            </ol>
                        </p>
                    </div>

                    <!-- Criteria Weights Table -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Current Criteria Weights</h3>

                        @if($criteria->isEmpty())
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">No criteria found for this position. Please add criteria first.</span>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria Code</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria Name</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight (%)</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
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
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ number_format($criterium->weight * 100, 2) }}%
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ $criterium->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- Calculate Weights Button -->
                    @if($criteria->count() > 1)
                        <div class="flex justify-center">
                            <form action="{{ route('smart.calculate-weights', $job->job_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Recalculate Weights using AHP
                                </button>
                            </form>
                        </div>

                        <div class="mt-6 text-center text-sm text-gray-600">
                            <p>Note: To set up pairwise comparisons for AHP calculation, please visit:</p>
                            <a href="{{ route('ahp.index', $job->job_id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                AHP Pairwise Comparison Matrix
                            </a>
                        </div>
                    @elseif($criteria->count() == 1)
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">
                                Only one criterion found. AHP requires at least two criteria for comparisons.
                                <a href="{{ route('criteria.create', ['job_id' => $job->job_id]) }}" class="font-medium underline">Add more criteria</a>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
