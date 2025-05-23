<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-brain text-indigo-600 mr-2"></i>
                SMART Analysis Dashboard -
                <span class="ml-2 px-3 py-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm rounded-full">
                    {{ $criteria->isNotEmpty() ? $criteria->first()->job->nama_job : 'No job selected' }}
                </span>
            </h2>
            <a href="{{ route('evaluasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Back to Evaluations
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg p-6 text-white transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm">Total Criteria</p>
                            <p class="text-3xl font-bold">{{ $criteria->count() }}</p>
                        </div>
                        <i class="fas fa-tasks text-4xl text-indigo-200 opacity-50"></i>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-lg p-6 text-white transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Total Interns</p>
                            <p class="text-3xl font-bold">{{ $interns->count() }}</p>
                        </div>
                        <i class="fas fa-user-graduate text-4xl text-green-200 opacity-50"></i>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg shadow-lg p-6 text-white transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm">Total Weeks</p>
                            <p class="text-3xl font-bold">{{ $weekCount }}</p>
                        </div>
                        <i class="fas fa-calendar-week text-4xl text-yellow-200 opacity-50"></i>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-pink-500 to-rose-600 rounded-lg shadow-lg p-6 text-white transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm">Current Period</p>
                            <p class="text-lg font-bold">{{ $periods->firstWhere('periode_id', $selectedPeriodeId)->nama_periode ?? 'N/A' }}</p>
                        </div>
                        <i class="fas fa-clock text-4xl text-pink-200 opacity-50"></i>
                    </div>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-6 rounded-lg shadow-lg mb-6 border border-blue-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-filter text-indigo-600 mr-2"></i> Dashboard Filters
                </h3>
                <form method="GET" action="{{ route('test.evaluasi.dashboard') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="job_id" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-briefcase text-gray-400"></i>
                            </div>
                            <select id="job_id" name="job_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach($jobs as $job)
                                    <option value="{{ $job->job_id }}" {{ $jobId == $job->job_id ? 'selected' : '' }}>
                                        {{ $job->nama_job }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="periode_id" class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <select id="periode_id" name="periode_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach($periods as $period)
                                    <option value="{{ $period->periode_id }}" {{ $selectedPeriodeId == $period->periode_id ? 'selected' : '' }}>
                                        {{ $period->nama_periode }} ({{ $period->tanggal_mulai->format('d M Y') }} - {{ $period->tanggal_selesai->format('d M Y') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition duration-150 hover:scale-105">
                            <i class="fas fa-search mr-2"></i> Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            <!-- SMART Method Information -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 border border-gray-200">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                    <h3 class="text-xl font-bold text-white mb-2 flex items-center">
                        <i class="fas fa-lightbulb text-yellow-300 mr-2"></i> Understanding SMART Method
                    </h3>
                    <p class="text-indigo-100">
                        SMART (Simple Multi-Attribute Rating Technique) evaluates alternatives based on multiple weighted criteria
                    </p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-lg border border-blue-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    1
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Criteria Weights</h4>
                            </div>
                            <p class="text-sm text-gray-600">
                                Weights are calculated using AHP (Analytic Hierarchy Process) through pairwise comparisons to determine importance.
                            </p>
                            <div class="mt-3 flex items-center text-blue-600 text-sm font-medium">
                                <i class="fas fa-balance-scale mr-1"></i> Weight Assignment
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-lg border border-purple-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    2
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Normalization</h4>
                            </div>
                            <p class="text-sm text-gray-600">
                                Raw scores are normalized to a 0-1 scale using min-max normalization for fair comparison across criteria.
                            </p>
                            <div class="mt-3 flex items-center text-purple-600 text-sm font-medium">
                                <i class="fas fa-percentage mr-1"></i> Scale Conversion
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-lg border border-green-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    3
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Final Calculation</h4>
                            </div>
                            <p class="text-sm text-gray-600">
                                Normalized values × weights are summed to get final scores for ranking alternatives.
                            </p>
                            <div class="mt-3 flex items-center text-green-600 text-sm font-medium">
                                <i class="fas fa-calculator mr-1"></i> Score Computation
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Criteria Weights Section -->
            @if(isset($criteria) && $criteria->count() > 0)
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 border border-gray-200">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-weight text-white mr-2"></i> Criteria Weights Distribution
                        </h3>
                        <a href="{{ route('ahp.index', $jobId) }}" class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm border border-white border-opacity-30 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-30 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-orange-500 transition ease-in-out duration-150 transform hover:scale-105">
                            <i class="fas fa-sync-alt mr-2"></i> Recalculate AHP
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Criteria Table -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-table text-indigo-600 mr-2"></i> Weight Details
                            </h4>
                            <div class="overflow-x-auto bg-gray-50 rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-100 to-gray-200">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criteria->sortByDesc('weight')->values() as $index => $criterion)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full
                                                    {{ $index == 0 ? 'bg-yellow-100 text-yellow-800' : ($index == 1 ? 'bg-gray-100 text-gray-800' : ($index == 2 ? 'bg-orange-100 text-orange-800' : 'bg-gray-50 text-gray-600')) }}
                                                    text-xs font-bold">
                                                    {{ $index + 1 }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded">
                                                    {{ $criterion->code }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $criterion->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-20 bg-gray-200 rounded-full h-2.5 mr-2">
                                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2.5 rounded-full transition-all duration-500"
                                                             style="width: {{ $criterion->weight * 100 }}%"></div>
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-900">{{ number_format($criterion->weight * 100, 1) }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Visual Chart -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-chart-pie text-purple-600 mr-2"></i> Visual Distribution
                            </h4>
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-lg border border-purple-100">
                                <div class="space-y-4">
                                    @foreach($criteria->sortByDesc('weight') as $criterion)
                                    <div class="transform transition duration-200 hover:scale-105">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-gray-700">{{ $criterion->code }} - {{ $criterion->name }}</span>
                                            <span class="text-sm font-bold text-purple-700">{{ number_format($criterion->weight * 100, 1) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-3">
                                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-500 relative"
                                                 style="width: {{ $criterion->weight * 100 }}%">
                                                <span class="absolute right-0 top-0 h-3 w-3 bg-white rounded-full border-2 border-purple-600 animate-pulse"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-6 p-4 bg-white bg-opacity-70 rounded-lg">
                                    <p class="text-xs text-gray-600 flex items-start">
                                        <i class="fas fa-info-circle text-purple-500 mr-1 mt-0.5"></i>
                                        These weights were calculated using the AHP (Analytic Hierarchy Process) method and represent the relative importance of each criterion in the evaluation process.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Weekly Rankings Section -->
            @if(isset($weeklyRankings) && $weekCount > 0)
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 border border-gray-200">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-trophy text-yellow-300 mr-2"></i> Weekly SMART Rankings
                    </h3>
                    <p class="text-green-100 text-sm mt-1">Performance rankings based on SMART calculations for each week</p>
                </div>

                <div class="p-6">
                    <!-- Week Tabs -->
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="-mb-px flex space-x-2 overflow-x-auto" aria-label="Tabs">
                            @for($week = 1; $week <= $weekCount; $week++)
                            <button type="button" class="week-tab flex-shrink-0 {{ $week == 1 ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} px-4 py-2 rounded-t-lg font-medium text-sm transition-all duration-200 transform hover:-translate-y-0.5" data-week="{{ $week }}">
                                <i class="fas fa-calendar-week mr-1"></i> Week {{ $week }}
                            </button>
                            @endfor
                        </nav>
                    </div>

                    <!-- Week Panels -->
                    @for($week = 1; $week <= $weekCount; $week++)
                    <div id="week-panel-{{ $week }}" class="week-panel {{ $week == 1 ? '' : 'hidden' }}">
                        @if(isset($weeklyRankings[$week]) && count($weeklyRankings[$week]) > 0)
                        <!-- Top 3 Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            @foreach($weeklyRankings[$week]->take(3) as $index => $ranking)
                            <div class="bg-gradient-to-br {{ $index == 0 ? 'from-yellow-400 to-orange-500' : ($index == 1 ? 'from-gray-300 to-gray-500' : 'from-orange-300 to-orange-500') }} p-1 rounded-lg shadow-lg transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                                <div class="bg-white rounded-lg p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 {{ $index == 0 ? 'bg-yellow-100' : ($index == 1 ? 'bg-gray-100' : 'bg-orange-100') }} rounded-full flex items-center justify-center mr-3">
                                                <span class="text-2xl font-bold {{ $index == 0 ? 'text-yellow-700' : ($index == 1 ? 'text-gray-700' : 'text-orange-700') }}">
                                                    {{ $ranking['rank'] }}
                                                </span>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800">{{ $ranking['pelamar_nama'] }}</h4>
                                                <p class="text-sm text-gray-600">{{ $criteria->first()->job->nama_job ?? '' }}</p>
                                            </div>
                                        </div>
                                        <i class="fas {{ $index == 0 ? 'fa-crown text-yellow-500' : ($index == 1 ? 'fa-medal text-gray-500' : 'fa-award text-orange-500') }} text-2xl"></i>
                                    </div>
                                    <div class="mt-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm text-gray-600">SMART Score</span>
                                            <span class="text-lg font-bold text-indigo-600">{{ number_format($ranking['total_score'], 4) }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full"
                                                 style="width: {{ $ranking['total_score'] * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Full Rankings Table -->
                        <div class="overflow-x-auto bg-gray-50 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-100 to-gray-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intern</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Score</th>
                                        @foreach($criteria as $criterion)
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="inline-flex items-center">
                                                {{ $criterion->code }}
                                                <span class="ml-1 text-gray-400" title="{{ $criterion->name }}">
                                                    <i class="fas fa-info-circle text-xs"></i>
                                                </span>
                                            </span>
                                        </th>
                                        @endforeach
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($weeklyRankings[$week] as $ranking)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full
                                                {{ $ranking['rank'] == 1 ? 'bg-yellow-100 text-yellow-800' : ($ranking['rank'] == 2 ? 'bg-gray-100 text-gray-800' : ($ranking['rank'] == 3 ? 'bg-orange-100 text-orange-800' : 'bg-gray-50 text-gray-600')) }}
                                                text-sm font-bold">
                                                {{ $ranking['rank'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full flex items-center justify-center text-white text-xs font-bold mr-3">
                                                    {{ substr($ranking['pelamar_nama'], 0, 1) }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-900">{{ $ranking['pelamar_nama'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex flex-col items-center">
                                                <span class="text-lg font-bold text-indigo-600">{{ number_format($ranking['total_score'], 4) }}</span>
                                                <div class="w-20 bg-gray-200 rounded-full h-1.5 mt-1">
                                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-1.5 rounded-full"
                                                         style="width: {{ $ranking['total_score'] * 100 }}%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        @foreach($criteria as $criterion)
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                                @php
                                                    $found = false;
                                                    $criteriaDetail = null;
                                                    foreach($ranking['score_details'] as $detail) {
                                                        if($detail['criteria_id'] === $criterion->criteria_id) {
                                                            $found = true;
                                                            $criteriaDetail = $detail;
                                                            break;
                                                        }
                                                    }
                                                @endphp

                                                @if($found)
                                                    <div class="group relative cursor-pointer">
                                                        <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-medium">
                                                            {{ number_format($criteriaDetail['weighted_score'], 3) }}
                                                        </span>
                                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block z-10">
                                                            <div class="bg-gray-800 text-white text-xs rounded py-2 px-3 whitespace-nowrap">
                                                                <div>Raw: {{ number_format($criteriaDetail['raw_value'], 2) }}</div>
                                                                <div>Normalized: {{ number_format($criteriaDetail['normalized_value'], 4) }}</div>
                                                                <div>Weight: {{ number_format($criteriaDetail['weight'], 4) }}</div>
                                                            </div>
                                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-l-transparent border-r-4 border-r-transparent border-t-4 border-t-gray-800"></div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-gray-300">-</span>
                                                @endif
                                            </td>
                                        @endforeach

                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @php
                                                $internRecord = $interns->firstWhere('magang_id', $ranking['magang_id']);
                                            @endphp
                                            @if($internRecord)
                                                <a href="{{ route('magang.show', $internRecord) }}" class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-xs font-medium rounded-full hover:from-indigo-600 hover:to-purple-700 transform transition duration-150 hover:scale-105">
                                                    <i class="fas fa-eye mr-1"></i> View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- SMART Calculation Methodology -->
                        @if(isset($weeklyRankings[$week]) && count($weeklyRankings[$week]) > 0)
                        <div class="mt-8">
                            <button onclick="toggleMethodology({{ $week }})" class="w-full bg-gradient-to-r from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 p-4 rounded-lg border border-indigo-200 transition duration-150 flex items-center justify-between group">
                                <span class="font-semibold text-indigo-900 flex items-center">
                                    <i class="fas fa-graduation-cap mr-2"></i> Detailed SMART Calculation Steps
                                </span>
                                <i id="methodology-chevron-{{ $week }}" class="fas fa-chevron-down text-indigo-600 transform transition-transform duration-300 group-hover:text-indigo-800"></i>
                            </button>

                            <div id="methodology-content-{{ $week }}" class="hidden mt-4 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6 rounded-lg border border-indigo-100">
                                <!-- Example calculation content -->
                                @php
                                    $exampleIntern = $weeklyRankings[$week][0] ?? null;
                                    $exampleCriterion = $exampleIntern && isset($exampleIntern['score_details'][0]) ? $exampleIntern['score_details'][0] : null;
                                @endphp

                                @if($exampleIntern && $exampleCriterion)
                                <div class="space-y-6">
                                    <div class="bg-white rounded-lg p-6 shadow-sm">
                                        <h4 class="font-semibold text-lg text-gray-800 mb-4 flex items-center">
                                            <i class="fas fa-user-graduate text-indigo-600 mr-2"></i>
                                            Example: {{ $exampleIntern['pelamar_nama'] }}
                                        </h4>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Step Cards -->
                                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                                <div class="flex items-center mb-2">
                                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-2">
                                                        1
                                                    </div>
                                                    <h5 class="font-semibold text-blue-900">Raw Scores</h5>
                                                </div>
                                                <p class="text-sm text-blue-700">
                                                    {{ $exampleCriterion['criteria_name'] }}: {{ number_format($exampleCriterion['raw_value'], 2) }}
                                                </p>
                                            </div>

                                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                                <div class="flex items-center mb-2">
                                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-2">
                                                        2
                                                    </div>
                                                    <h5 class="font-semibold text-purple-900">Normalization</h5>
                                                </div>
                                                <p class="text-sm text-purple-700">
                                                    Normalized: {{ number_format($exampleCriterion['normalized_value'], 4) }}
                                                </p>
                                            </div>

                                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                                <div class="flex items-center mb-2">
                                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mr-2">
                                                        3
                                                    </div>
                                                    <h5 class="font-semibold text-green-900">Apply Weight</h5>
                                                </div>
                                                <p class="text-sm text-green-700">
                                                    Weight: {{ number_format($exampleCriterion['weight'], 4) }}
                                                </p>
                                            </div>

                                            <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                                                <div class="flex items-center mb-2">
                                                    <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold mr-2">
                                                        4
                                                    </div>
                                                    <h5 class="font-semibold text-orange-900">Final Score</h5>
                                                </div>
                                                <p class="text-sm text-orange-700">
                                                    Total: {{ number_format($exampleIntern['total_score'], 4) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Formula Display -->
                                    <div class="bg-white rounded-lg p-6 shadow-sm">
                                        <h5 class="font-semibold text-gray-800 mb-3 flex items-center">
                                            <i class="fas fa-calculator text-purple-600 mr-2"></i> Mathematical Formula
                                        </h5>
                                        <div class="bg-gray-100 p-4 rounded font-mono text-sm">
                                            <p class="mb-2">Normalization: Ui = (xi - xmin) / (xmax - xmin)</p>
                                            <p class="mb-2">Weighted Score: Si = Ui × wi</p>
                                            <p>Total Score: S = Σ(Si)</p>
                                        </div>
                                    </div>

                                    <!-- Progressive Weighting Info -->
                                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-lg border border-yellow-200">
                                        <h5 class="font-semibold text-orange-800 mb-2 flex items-center">
                                            <i class="fas fa-chart-line text-orange-600 mr-2"></i> Weekly Progressive Weighting
                                        </h5>
                                        <p class="text-sm text-gray-700 mb-3">
                                            For overall rankings, later weeks receive higher weights to reflect skill progression:
                                        </p>
                                        <div class="grid grid-cols-{{ min($weekCount, 4) }} gap-2">
                                            @for($i = 1; $i <= $weekCount; $i++)
                                            <div class="bg-white p-3 rounded text-center">
                                                <p class="text-xs text-gray-600">Week {{ $i }}</p>
                                                <p class="text-lg font-bold text-orange-600">
                                                    {{ number_format(($i / array_sum(range(1, $weekCount))) * 100, 1) }}%
                                                </p>
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        @else
                        <div class="text-center py-12 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg">
                            <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg">No rankings available for Week {{ $week }}.</p>
                            <p class="text-gray-400 text-sm mt-2">Complete evaluations to see SMART rankings</p>
                        </div>
                        @endif
                    </div>
                    @endfor
                </div>
            </div>
            @endif

            <!-- Summary Stats -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 rounded-lg shadow-lg p-6 text-white">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div>
                        <i class="fas fa-chart-line text-4xl mb-2 text-indigo-200"></i>
                        <p class="text-indigo-100">Average Score Range</p>
                        <p class="text-2xl font-bold">
                            @if(isset($weeklyRankings) && count($weeklyRankings) > 0)
                                {{ number_format(collect($weeklyRankings)->flatten(1)->min('total_score'), 3) }} -
                                {{ number_format(collect($weeklyRankings)->flatten(1)->max('total_score'), 3) }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div>
                        <i class="fas fa-users text-4xl mb-2 text-purple-200"></i>
                        <p class="text-purple-100">Total Evaluations</p>
                        <p class="text-2xl font-bold">
                            {{ isset($weeklyRankings) ? collect($weeklyRankings)->flatten(1)->count() : 0 }}
                        </p>
                    </div>
                    <div>
                        <i class="fas fa-percentage text-4xl mb-2 text-pink-200"></i>
                        <p class="text-pink-100">Completion Rate</p>
                        <p class="text-2xl font-bold">
                            @php
                                $totalPossible = $interns->count() * $weekCount;
                                $totalActual = isset($weeklyRankings) ? collect($weeklyRankings)->flatten(1)->count() : 0;
                                $completionRate = $totalPossible > 0 ? ($totalActual / $totalPossible) * 100 : 0;
                            @endphp
                            {{ number_format($completionRate, 1) }}%
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize animations
            animateOnLoad();

            // Tab functionality
            const tabs = document.querySelectorAll('.week-tab');
            const panels = document.querySelectorAll('.week-panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const week = tab.getAttribute('data-week');

                    // Update panels
                    panels.forEach(panel => panel.classList.add('hidden'));
                    document.getElementById(`week-panel-${week}`).classList.remove('hidden');

                    // Update tab styles
                    tabs.forEach(t => {
                        t.classList.remove('bg-gradient-to-r', 'from-indigo-500', 'to-purple-600', 'text-white');
                        t.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    });

                    tab.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    tab.classList.add('bg-gradient-to-r', 'from-indigo-500', 'to-purple-600', 'text-white');

                    // Animate new content
                    animatePanel(week);
                });
            });

            // Auto-submit filters on change
            document.getElementById('job_id').addEventListener('change', function() {
                showLoadingOverlay();
                this.form.submit();
            });

            document.getElementById('periode_id').addEventListener('change', function() {
                showLoadingOverlay();
                this.form.submit();
            });
        });

        // Toggle methodology content
        function toggleMethodology(week) {
            const content = document.getElementById(`methodology-content-${week}`);
            const chevron = document.getElementById(`methodology-chevron-${week}`);

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                chevron.classList.add('rotate-180');

                // Animate content
                content.style.opacity = '0';
                content.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    content.style.transition = 'all 0.3s ease-out';
                    content.style.opacity = '1';
                    content.style.transform = 'translateY(0)';
                }, 10);
            } else {
                content.style.opacity = '0';
                content.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    content.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
                }, 300);
            }
        }

        // Animate elements on load
        function animateOnLoad() {
            const elements = document.querySelectorAll('.transform');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 50);
            });

            // Animate progress bars
            setTimeout(() => {
                const bars = document.querySelectorAll('[style*="width"]');
                bars.forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 100);
                });
            }, 500);
        }

        // Animate panel content
        function animatePanel(week) {
            const panel = document.getElementById(`week-panel-${week}`);
            const cards = panel.querySelectorAll('.bg-gradient-to-br');

            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9)';

                setTimeout(() => {
                    card.style.transition = 'all 0.3s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, index * 100);
            });
        }

        // Show loading overlay
        function showLoadingOverlay() {
            const overlay = document.createElement('div');
            overlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            overlay.innerHTML = `
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto mb-4"></div>
                    <p class="text-gray-700">Loading dashboard...</p>
                </div>
            `;
            document.body.appendChild(overlay);
        }

        // Copy to clipboard functionality
        function copyToClipboard(text, element) {
            navigator.clipboard.writeText(text).then(() => {
                const originalText = element.textContent;
                element.textContent = 'Copied!';
                element.classList.add('bg-green-600');

                setTimeout(() => {
                    element.textContent = originalText;
                    element.classList.remove('bg-green-600');
                }, 2000);
            });
        }
    </script>
</x-app-layout>