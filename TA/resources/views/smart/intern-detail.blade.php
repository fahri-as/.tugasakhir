<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Intern Detail') }} - {{ $magang->pelamar->nama }}
            </h2>
            <a href="{{ route('smart.rankings', $job->job_id) }}?periode_id={{ $periode->periode_id ?? '' }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back to Rankings
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Intern Info Card -->
                    <div class="bg-gray-50 p-4 rounded-md mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Intern Information</h3>
                                <p class="text-sm text-gray-600"><span class="font-medium">ID:</span> {{ $magang->magang_id }}</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Name:</span> {{ $magang->pelamar->nama }}</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Email:</span> {{ $magang->pelamar->email }}</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Position:</span> {{ $job->nama_job }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Internship Details</h3>
                                <p class="text-sm text-gray-600"><span class="font-medium">Period:</span> {{ $periode->nama_periode }}</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Status:</span> {{ $magang->status_seleksi }}</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Rank:</span> {{ $magang->rank ?: 'Not Ranked' }}</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Total SMART Score:</span> {{ number_format($magang->total_skor, 4) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Criteria Weights Summary -->
                    <div class="mb-6">
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
                    </div>

                    <!-- Weekly SMART Scores -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Weekly SMART Scores</h3>

                        @if(empty($weeklyScores))
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">No weekly evaluations found for this intern.</span>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-6">
                                @foreach($weeklyScores as $week => $weekScore)
                                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                            <h4 class="text-lg font-medium text-gray-900">Week {{ $week }} - SMART Score: {{ number_format($weekScore['total_score'], 4) }}</h4>
                                        </div>

                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Raw Value</th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min/Max Range</th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Normalized</th>
                                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weighted</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach($weekScore['evaluation_details'] as $detail)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                {{ $detail['criteria_name'] }} ({{ $detail['criteria_code'] }})
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ number_format($detail['criteria_weight'], 4) }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ number_format($detail['raw_value'], 2) }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ number_format($detail['min_value'], 2) }} - {{ number_format($detail['max_value'], 2) }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ number_format($detail['normalized_value'], 4) }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ number_format($detail['weighted_value'], 4) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <!-- Total Row -->
                                                    <tr class="bg-gray-50">
                                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                                            Total SMART Score (Week {{ $week }}):
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {{ number_format($weekScore['total_score'], 4) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- SMART Formula Explanation -->
                            <div class="mt-6 bg-gray-50 p-4 rounded-md">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">SMART Method Formula:</h4>
                                <p class="text-sm text-gray-600">
                                    1. Normalization: (Value - Min) / (Max - Min)<br>
                                    2. Weighted Value: Normalized Value × Criteria Weight<br>
                                    3. Weekly Score: Sum of all Weighted Values for that week<br>
                                    4. Total Score: Sum of all Weekly Scores
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
