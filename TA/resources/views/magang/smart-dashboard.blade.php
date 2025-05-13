<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            SMART Dashboard for {{ $job->nama_job }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
            <!-- Page header with navigation -->
            <div class="mb-6 flex justify-between items-center">
                <div class="flex space-x-2">
                    <a href="{{ route('magang.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                        Back to Internships
                    </a>
                    <a href="{{ route('ahp.index', $jobId) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        AHP Criteria Weights
                    </a>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('magang.smartDashboard') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label for="periode_id" class="block text-sm font-medium text-gray-700 mb-1">Filter by Period</label>
                            <select id="periode_id" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach($periods as $period)
                                    <option value="{{ $period->periode_id }}" {{ $selectedPeriodeId == $period->periode_id ? 'selected' : '' }}>
                                        {{ $period->nama_periode }} ({{ $period->tanggal_mulai->format('d M Y') }} - {{ $period->tanggal_selesai->format('d M Y') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="job_id" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                            <select id="job_id" name="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach($jobs as $job)
                                    <option value="{{ $job->job_id }}" {{ $jobId == $job->job_id ? 'selected' : '' }}>
                                        {{ $job->nama_job }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SMART Method Information -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
                    <h2 class="text-lg font-medium text-gray-800">About SMART Evaluation Method</h2>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-4">
                        SMART (Simple Multi-Attribute Rating Technique) is a decision support method that evaluates alternatives based on multiple criteria with different weights. In this system, it's used to rank interns objectively based on their performance in weekly evaluations.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium mb-2">1. Criteria Weighting</h3>
                            <p class="text-sm text-gray-600">
                                Using AHP (Analytic Hierarchy Process), we determine the relative importance of each evaluation criterion through pairwise comparisons.
                            </p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium mb-2">2. Weekly Evaluations</h3>
                            <p class="text-sm text-gray-600">
                                Interns are evaluated weekly against each criterion, with scores normalized across all interns for fair comparison.
                            </p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium mb-2">3. Final Ranking</h3>
                            <p class="text-sm text-gray-600">
                                The weighted sum of normalized scores provides a composite ranking score, with later weeks potentially having higher weight in the final score.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Criteria Weights -->
            @if($criteria->isNotEmpty())
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-800">Criteria Weights</h2>
                    <a href="{{ route('ahp.index', $jobId) }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                        Recalculate with AHP
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Criteria Weights Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($criteria->sortByDesc('weight') as $criterion)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $criterion->code }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $criterion->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <span class="mr-2">{{ number_format($criterion->weight, 4) }}</span>
                                                <div class="w-24 bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $criterion->weight * 100 }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Weight Visualization Chart -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium mb-4">Criteria Weight Distribution</h3>
                            <div class="space-y-3">
                                @foreach($criteria->sortByDesc('weight') as $criterion)
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>{{ $criterion->code }} - {{ $criterion->name }}</span>
                                        <span>{{ number_format($criterion->weight * 100, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $criterion->weight * 100 }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Overall Rankings Table -->
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
                    <h2 class="text-lg font-medium text-gray-800">Overall SMART Rankings</h2>
                </div>
                <div class="p-6">
                    @if($interns->isEmpty())
                    <div class="text-center py-8 bg-gray-50 rounded-lg">
                        <p class="text-gray-500">No active interns found for this position and period.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Score</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($interns as $intern)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center justify-center h-6 w-6 rounded-full {{ $intern->rank == 1 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }} font-medium">
                                            {{ $intern->rank ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $intern->pelamar->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $intern->status_seleksi === 'Sedang Berjalan' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $intern->status_seleksi === 'Lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $intern->status_seleksi === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $intern->status_seleksi === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                            {{ $intern->status_seleksi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $intern->jadwal_mulai ? $intern->jadwal_mulai->format('d M Y') : 'Not scheduled' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ number_format($intern->total_skor, 2) }}/5
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('magang.show', $intern) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Weekly Performance Tabs -->
            @if($weekCount > 0 && $interns->isNotEmpty())
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
                    <h2 class="text-lg font-medium text-gray-800">Weekly Performance Analysis</h2>
                </div>
                <div class="p-6">
                    <!-- Week Tabs -->
                    <div class="border-b border-gray-200 mb-6">
                        <div class="flex overflow-x-auto scrollbar-hide pb-1">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                @for($week = 1; $week <= $weekCount; $week++)
                                <button type="button" class="week-tab {{ $week == 1 ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-week="{{ $week }}">
                                    Week {{ $week }}
                                </button>
                                @endfor
                            </nav>
                        </div>
                    </div>

                    <!-- Week Panels -->
                    @for($week = 1; $week <= $weekCount; $week++)
                    <div id="week-panel-{{ $week }}" class="week-panel {{ $week == 1 ? '' : 'hidden' }}">
                        @if(isset($weeklyRankings[$week]) && count($weeklyRankings[$week]) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SMART Score</th>
                                        @foreach($criteria as $criterion)
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $criterion->code }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($weeklyRankings[$week] as $ranking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center justify-center h-6 w-6 rounded-full {{ $ranking['rank'] == 1 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }} font-medium">
                                                {{ $ranking['rank'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $ranking['pelamar_nama'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ number_format($ranking['total_score'], 4) }}
                                        </td>

                                        @foreach($criteria as $criterion)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @php
                                                $criteriaDetail = collect($ranking['score_details'])->firstWhere('criteria_id', $criterion->criteria_id);
                                            @endphp

                                            @if($criteriaDetail)
                                                <span title="Raw: {{ number_format($criteriaDetail['raw_value'], 2) }}">
                                                    {{ number_format($criteriaDetail['weighted_score'], 4) }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-8 bg-gray-50 rounded-lg">
                            <p class="text-gray-500">No evaluations found for Week {{ $week }}.</p>
                        </div>
                        @endif
                    </div>
                    @endfor
                </div>
            </div>
            @endif

            <!-- Criteria Contribution Analysis -->
            @if($interns->isNotEmpty() && !empty($criteriaContributions))
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
                    <h2 class="text-lg font-medium text-gray-800">Criteria Contribution Analysis</h2>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-6">
                        This analysis shows which criteria have the most impact on each intern's overall score. The percentages represent how much each criterion contributes to the total score.
                    </p>

                    <div class="space-y-6">
                        @foreach($interns as $intern)
                        @if(!empty($criteriaContributions[$intern->magang_id]))
                        <div class="border rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                                <h3 class="font-medium">{{ $intern->pelamar->nama }} <span class="text-sm text-gray-500">(Rank: {{ $intern->rank ?? '-' }})</span></h3>
                                <span class="text-sm font-medium">Score: {{ number_format($intern->total_skor, 2) }}</span>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($criteriaContributions[$intern->magang_id] as $contribution)
                                    <div class="bg-white border rounded p-3">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h4 class="text-sm font-medium">{{ $contribution['code'] }}</h4>
                                                <p class="text-xs text-gray-500">{{ $contribution['name'] }}</p>
                                            </div>
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded">
                                                {{ number_format($contribution['percentage'], 1) }}%
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                            <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $contribution['percentage'] }}%"></div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            </div>
        </div>
    </div>

    <!-- JavaScript for tabs -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.week-tab');
            const panels = document.querySelectorAll('.week-panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const week = tab.getAttribute('data-week');

                    // Hide all panels and remove active class from tabs
                    panels.forEach(panel => panel.classList.add('hidden'));
                    tabs.forEach(t => {
                        t.classList.remove('border-indigo-500', 'text-indigo-600');
                        t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    });

                    // Show selected panel and add active class to tab
                    document.getElementById(`week-panel-${week}`).classList.remove('hidden');
                    tab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    tab.classList.add('border-indigo-500', 'text-indigo-600');
                });
            });

            // Auto-submit filter form when selects change
            document.getElementById('periode_id').addEventListener('change', function() {
                this.form.submit();
            });

            document.getElementById('job_id').addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>
</x-app-layout>
