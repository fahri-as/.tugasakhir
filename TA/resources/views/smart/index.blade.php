<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            SMART Ranking for {{ $job->nama_job }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="mb-6">
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            This page displays the applicant ranking results based on the SMART (Simple Multi-Attribute Rating Technique) method.
                            The ranking uses the criteria weights calculated through the AHP method.
                        </p>

                        @if(!$hasCalculatedWeights)
                            <div class="bg-yellow-100 dark:bg-yellow-800 p-4 rounded-md mb-6">
                                <h3 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-2">Criteria Weights Required</h3>
                                <p class="text-yellow-700 dark:text-yellow-300">
                                    Please calculate criteria weights using the AHP method first.
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('ahp.index', $job->job_id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Go to AHP Weighting
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="bg-green-100 dark:bg-green-800 p-4 rounded-md mb-6">
                                <h3 class="font-semibold text-green-800 dark:text-green-200 mb-2">Current Criteria Weights</h3>
                                <ul class="list-disc list-inside">
                                    @foreach($criteria as $criterion)
                                        <li class="text-green-700 dark:text-green-300">
                                            {{ $criterion->name }} ({{ $criterion->code }}): {{ number_format($criterion->weight * 100, 2) }}%
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    @if(count($applicants) > 0 && $hasCalculatedWeights)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4 sm:p-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Applicant Rankings</h3>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rank</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Applicant</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Score</th>
                                                @foreach($criteria as $criterion)
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ $criterion->code }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                                            @foreach($rankings as $ranking)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $ranking['rank'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $ranking['applicant_name'] }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300 font-bold">{{ number_format($ranking['score'] * 100, 2) }}</td>
                                                    @foreach($criteria as $criterion)
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                                            @if(isset($ranking['details'][$criterion->code]))
                                                                {{ number_format($ranking['details'][$criterion->code]['utility'] * 100, 2) }}
                                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                                    ({{ number_format($ranking['details'][$criterion->code]['weighted_utility'] * 100, 2) }})
                                                                </span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-6">
                                    <h4 class="text-md font-medium text-gray-900 dark:text-gray-100 mb-2">Apply Results to Internship Selection</h4>
                                    <form action="{{ route('smart.apply-ranking', $job->job_id) }}" method="POST">
                                        @csrf
                                        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-end">
                                            <div>
                                                <label for="apply_count" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of applicants to accept</label>
                                                <input type="number" name="apply_count" id="apply_count" min="1" max="{{ count($rankings) }}" value="1" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                Apply Rankings to Selection
                                            </button>
                                        </div>

                                        <!-- Hidden applicant IDs in ranked order -->
                                        @foreach($rankings as $ranking)
                                            <input type="hidden" name="applicant_ids[]" value="{{ $ranking['applicant_id'] }}">
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    @elseif(!$hasCalculatedWeights)
                        <!-- Weights not calculated message shown above -->
                    @else
                        <div class="bg-yellow-100 dark:bg-yellow-800 p-4 rounded-md mb-6">
                            <h3 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-2">No Applicants Found</h3>
                            <p class="text-yellow-700 dark:text-yellow-300">
                                No applicants were found for this position. Please add applicants first.
                            </p>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
