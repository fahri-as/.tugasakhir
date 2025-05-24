<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-user-graduate text-indigo-600 mr-2"></i>
                {{ $magang->pelamar->nama }} - Internship Details
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('magang.edit', $magang) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                @if($magang->pelamar && $magang->pelamar->job_id &&
                    in_array($magang->pelamar->job_id, ['JOB001', 'JOB004']))
                    <a href="{{ route('magang.weeklyScores', $magang) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                        <i class="fas fa-chart-line mr-2"></i> Weekly Scores
                    </a>
                @endif
                <a href="{{ route('magang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-green-50" role="alert">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-red-50" role="alert">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Intern Header Card -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg mb-6 overflow-hidden">
                <div class="p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-20 w-20 rounded-full bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center text-white text-2xl font-bold mr-6 shadow-lg">
                                {{ substr($magang->pelamar->nama, 0, 1) }}
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold mb-2">{{ $magang->pelamar->nama }}</h1>
                                <p class="text-indigo-100 flex items-center mb-1">
                                    <i class="fas {{ $magang->pelamar->job->job_id == 'JOB001' ? 'fa-utensils' : 'fa-birthday-cake' }} mr-2"></i>
                                    {{ $magang->pelamar->job->nama_job ?? 'Not assigned' }}
                                </p>
                                <p class="text-indigo-100 flex items-center">
                                    <i class="fas fa-calendar mr-2"></i>
                                    {{ $magang->pelamar->periode->nama_periode ?? 'Not assigned' }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-6 py-4 mb-4">
                                <p class="text-sm text-indigo-100">Overall Rank</p>
                                <p class="text-4xl font-bold">#{{ $magang->rank ?? '-' }}</p>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-6 py-4">
                                <p class="text-sm text-indigo-100">Total Score</p>
                                <div class="flex items-center">
                                    <span class="text-3xl font-bold mr-2">{{ number_format($magang->total_skor, 2) }}</span>
                                    <span class="text-lg">/5.0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SMART Dashboard Links -->
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-5 mb-6 shadow-sm border border-indigo-100">
                <h2 class="text-lg font-medium mb-3 flex items-center">
                    <i class="fas fa-brain text-indigo-600 mr-2"></i> SMART Analysis Dashboards
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('magang.smartDashboard', ['job_id' => 'JOB001']) }}" class="flex items-center p-4 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50 transition duration-150 transform hover:-translate-y-1 hover:shadow-md">
                        <div class="bg-orange-100 p-3 rounded-full mr-4">
                            <i class="fas fa-utensils h-6 w-6 text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Cook Position Dashboard</h3>
                            <p class="text-sm text-gray-500">View SMART analysis for Cook position</p>
                        </div>
                    </a>

                    <a href="{{ route('magang.smartDashboard', ['job_id' => 'JOB004']) }}" class="flex items-center p-4 bg-white border border-pink-200 rounded-lg hover:bg-pink-50 transition duration-150 transform hover:-translate-y-1 hover:shadow-md">
                        <div class="bg-pink-100 p-3 rounded-full mr-4">
                            <i class="fas fa-birthday-cake h-6 w-6 text-pink-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Pastry Chef Dashboard</h3>
                            <p class="text-sm text-gray-500">View SMART analysis for Pastry Chef position</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Basic Information Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-indigo-100">
                        <h2 class="font-semibold text-lg flex items-center">
                            <i class="fas fa-id-card text-indigo-600 mr-2"></i> Intern Information
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-user text-gray-400 mr-2"></i> Full Name
                                </span>
                                <span class="font-medium text-gray-900">{{ $magang->pelamar->nama }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-briefcase text-gray-400 mr-2"></i> Position
                                </span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $magang->pelamar->job->job_id == 'JOB001' ? 'bg-orange-100 text-orange-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $magang->pelamar->job->nama_job ?? 'Not assigned' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-flag text-gray-400 mr-2"></i> Status
                                </span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $magang->status_seleksi === 'Sedang Berjalan' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $magang->status_seleksi === 'Lulus' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $magang->status_seleksi === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $magang->status_seleksi === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                    <i class="fas
                                        {{ $magang->status_seleksi === 'Sedang Berjalan' ? 'fa-play-circle' : '' }}
                                        {{ $magang->status_seleksi === 'Lulus' ? 'fa-check-circle' : '' }}
                                        {{ $magang->status_seleksi === 'Tidak Lulus' ? 'fa-times-circle' : '' }}
                                        {{ $magang->status_seleksi === 'Pending' ? 'fa-clock' : '' }}
                                        mr-1"></i>
                                    {{ $magang->status_seleksi }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-calendar-alt text-gray-400 mr-2"></i> Period
                                </span>
                                <span class="font-medium text-gray-900">{{ $magang->pelamar->periode->nama_periode ?? 'Not assigned' }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-calendar-check text-gray-400 mr-2"></i> Start Date
                                </span>
                                <span class="font-medium text-gray-900">
                                    @if($magang->jadwal_mulai)
                                        {{ $magang->jadwal_mulai->format('d M Y') }}
                                    @else
                                        Not scheduled
                                    @endif
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-envelope text-gray-400 mr-2"></i> Contact
                                </span>
                                <span class="font-medium text-gray-900">{{ $magang->pelamar->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SMART Score Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-100">
                        <h2 class="font-semibold text-lg flex items-center">
                            <i class="fas fa-brain text-purple-600 mr-2"></i> SMART Evaluation Results
                        </h2>
                    </div>
                    <div class="p-6">
                        @if(in_array($magang->pelamar->job_id ?? '', ['JOB001', 'JOB004']))
                            <div class="text-center mb-6">
                                <div class="relative inline-flex items-center justify-center w-32 h-32 mb-4">
                                    <svg class="w-32 h-32 transform -rotate-90">
                                        <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="8" fill="transparent"/>
                                        <circle cx="64" cy="64" r="56" stroke="url(#gradient)" stroke-width="8" fill="transparent"
                                                stroke-dasharray="{{ 2 * pi() * 56 }}"
                                                stroke-dashoffset="{{ 2 * pi() * 56 * (1 - ($magang->total_skor / 5)) }}"
                                                class="transition-all duration-1000 ease-out"/>
                                        <defs>
                                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:#8b5cf6"/>
                                                <stop offset="100%" style="stop-color:#ec4899"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-gray-900">{{ number_format($magang->total_skor, 2) }}</div>
                                            <div class="text-sm text-gray-500">out of 5.0</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Ranking</p>
                                        <p class="text-xl font-bold text-indigo-600">#{{ $magang->rank ?? '-' }}</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Performance</p>
                                        <p class="text-xl font-bold text-purple-600">{{ number_format(($magang->total_skor / 5) * 100, 1) }}%</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-sm text-gray-700 flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                                    SMART (Simple Multi-Attribute Rating Technique) evaluation assesses interns based on multiple weighted criteria. Scores are normalized and weighted using criteria importance determined through AHP.
                                </p>
                            </div>
                        @else
                            <div class="py-8 text-center">
                                <i class="fas fa-exclamation-triangle text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-lg">SMART evaluation is only available for Cook and Pastry Chef positions.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Weekly Scores Section -->
            @if(in_array($magang->pelamar->job_id ?? '', ['JOB001', 'JOB004']) && $weeklyScores && count($weeklyScores) > 0)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-green-100">
                    <h2 class="font-semibold text-lg flex items-center">
                        <i class="fas fa-chart-line text-green-600 mr-2"></i> Weekly SMART Scores
                    </h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <ul class="flex border-b overflow-x-auto">
                            @foreach($weeklyScores as $week => $score)
                            <li class="-mb-px mr-1 flex-shrink-0">
                                <a class="week-tab inline-block py-3 px-6 border-l border-t border-r rounded-t transition-all duration-200 {{ $loop->first ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white border-indigo-500' : 'text-indigo-600 hover:text-indigo-800 bg-white hover:bg-indigo-50 border-gray-300' }}"
                                   href="#"
                                   data-target="week-{{ $week }}">
                                    <i class="fas fa-calendar-week mr-2"></i>Week {{ $week }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="weekly-content">
                        @foreach($weeklyScores as $week => $score)
                        <div id="week-{{ $week }}" class="week-panel {{ $loop->first ? 'block' : 'hidden' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-lg border border-indigo-100">
                                    <h3 class="text-lg font-medium mb-4 flex items-center">
                                        <i class="fas fa-trophy text-indigo-600 mr-2"></i> Week {{ $week }} Performance
                                    </h3>
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Total Score</p>
                                            <p class="text-2xl font-bold text-indigo-600">{{ number_format($score['total'], 4) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Rank</p>
                                            <p class="text-2xl font-bold bg-indigo-100 text-indigo-800 rounded-full w-12 h-12 flex items-center justify-center">
                                                {{ $score['rank'] ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full transition-all duration-1000" style="width: {{ min($score['total'] * 100, 100) }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg border border-blue-100">
                                    <h3 class="text-lg font-medium mb-4 flex items-center">
                                        <i class="fas fa-chart-bar text-blue-600 mr-2"></i> Criteria Breakdown
                                    </h3>
                                    <div class="space-y-3">
                                        @forelse($score['criteria'] as $criteriaName => $criteriaScore)
                                        <div>
                                            <div class="flex justify-between text-sm mb-1">
                                                <span class="font-medium">{{ $criteriaName }}</span>
                                                <span class="text-blue-600 font-semibold">{{ number_format($criteriaScore, 4) }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full transition-all duration-500" style="width: {{ min($criteriaScore * 100, 100) }}%"></div>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="text-gray-500 text-sm italic">No criteria scores available</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Criteria Contribution Chart -->
            @if(in_array($magang->pelamar->job_id ?? '', ['JOB001', 'JOB004']) && $criteriaContribution && count($criteriaContribution) > 0)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-6 py-4 border-b border-yellow-100">
                    <h2 class="font-semibold text-lg flex items-center">
                        <i class="fas fa-chart-pie text-yellow-600 mr-2"></i> Criteria Contribution Analysis
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        @foreach($criteriaContribution as $contribution)
                        <div class="bg-gradient-to-br from-white to-gray-50 border rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $contribution['name'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $contribution['code'] }}</p>
                                </div>
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    {{ number_format($contribution['percentage'], 1) }}%
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full transition-all duration-1000" style="width: {{ $contribution['percentage'] }}%"></div>
                                </div>
                            </div>

                            <div class="space-y-1 text-xs text-gray-600">
                                <div class="flex justify-between">
                                    <span>Weight:</span>
                                    <span class="font-medium">{{ number_format($contribution['weight'], 4) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Contribution:</span>
                                    <span class="font-medium">{{ number_format($contribution['total_contribution'], 4) }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-sm text-gray-700 flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                            The percentages above show how much each criterion contributes to the intern's overall SMART score. Higher percentages indicate criteria that have more influence on the final ranking.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Weekly Evaluations Section -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-lg flex items-center">
                        <i class="fas fa-clipboard-list text-blue-600 mr-2"></i> Weekly Evaluations
                    </h2>
                    @if($magang->status_seleksi === 'Sedang Berjalan')
                    <a href="{{ route('evaluasi.create', ['magang_id' => $magang->magang_id]) }}"
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                        <i class="fas fa-plus mr-2"></i> Add Evaluation
                    </a>
                    @endif
                </div>
                <div class="p-6">
                    @if($evaluationsByWeek->count() > 0)
                    <div class="space-y-4" id="accordion">
                        @foreach($evaluationsByWeek->sortKeys() as $week => $evaluations)
                        <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm transform transition-all duration-200 hover:shadow-md">
                            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 cursor-pointer flex justify-between items-center week-header transform transition-all duration-200 hover:from-gray-100 hover:to-blue-100" data-week="{{ $week }}">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-week text-blue-600 mr-3"></i>
                                    <div class="font-medium text-gray-800">Week {{ $week }}</div>
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-4 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                        {{ $evaluations->count() }} evaluations
                                    </span>
                                    <i class="fas fa-chevron-down week-chevron text-gray-400 transform transition-transform duration-200"></i>
                                </div>
                            </div>
                            <div class="week-content hidden">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <i class="fas fa-tasks mr-1"></i> Criteria
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <i class="fas fa-star mr-1"></i> Rating
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <i class="fas fa-chart-line mr-1"></i> Score
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <i class="fas fa-cog mr-1"></i> Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($evaluations as $evaluation)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($evaluation->criteria)
                                                        <div class="font-medium text-gray-900">{{ $evaluation->criteria->name }}</div>
                                                        <div class="text-sm text-gray-500 flex items-center">
                                                            <span class="px-2 py-0.5 bg-indigo-100 text-indigo-800 text-xs rounded mr-2">{{ $evaluation->criteria->code }}</span>
                                                            Weight: {{ number_format($evaluation->criteria->weight ?? 0, 3) }}
                                                        </div>
                                                    @else
                                                        <span class="text-gray-500 italic flex items-center">
                                                            <i class="fas fa-question-circle mr-2"></i> No specific criteria
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $evaluation->criteriaRatingScale->name ?? 'N/A' }}
                                                    </span>
                                                    @if($evaluation->criteriaRatingScale)
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            Level: {{ $evaluation->criteriaRatingScale->rating_level }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="font-medium text-gray-900">{{ number_format($evaluation->skor_minggu, 2) }}</div>
                                                    <div class="w-16 bg-gray-200 rounded-full h-1.5 mt-1">
                                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-1.5 rounded-full" style="width: {{ min(($evaluation->skor_minggu / 5) * 100, 100) }}%"></div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('evaluasi.show', $evaluation) }}" class="text-blue-600 hover:text-blue-900 transform transition duration-150 hover:scale-110" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('evaluasi.edit', $evaluation) }}" class="text-indigo-600 hover:text-indigo-900 transform transition duration-150 hover:scale-110" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-gradient-to-r from-indigo-50 to-purple-50">
                                            <tr>
                                                <td colspan="2" class="px-6 py-3 text-sm font-medium text-gray-900 flex items-center">
                                                    <i class="fas fa-calculator text-indigo-600 mr-2"></i> Week Total
                                                </td>
                                                <td class="px-6 py-3 text-sm font-bold text-indigo-700">
                                                    {{ number_format($evaluations->sum('skor_minggu'), 2) }}
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <i class="fas fa-clipboard text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-lg mb-4">No evaluations have been recorded yet.</p>
                        @if($magang->status_seleksi === 'Sedang Berjalan')
                        <a href="{{ route('evaluasi.create', ['magang_id' => $magang->magang_id]) }}"
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                            <i class="fas fa-plus-circle mr-2"></i> Create First Evaluation
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex flex-wrap gap-4 justify-center">
                    <form action="{{ route('magang.updateStatus', $magang) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        @if($magang->status_seleksi === 'Sedang Berjalan')
                            <input type="hidden" name="status_seleksi" value="Lulus">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-check-circle mr-2"></i> Mark as Completed
                            </button>
                        @elseif($magang->status_seleksi === 'Pending')
                            <input type="hidden" name="status_seleksi" value="Sedang Berjalan">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-play-circle mr-2"></i> Start Internship
                            </button>
                        @endif
                    </form>

                    <form action="{{ route('magang.destroy', $magang) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this internship record? This will also delete all associated evaluations.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                            <i class="fas fa-trash mr-2"></i> Delete Record
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-gradient-to-r from-gray-50 to-blue-50 rounded-lg p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i> Score Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Total Score (0-5 scale)</p>
                        <p class="text-2xl font-bold text-indigo-600">{{ number_format($magang->total_skor, 2) }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Scaled Score (0-50 scale)</p>
                        <p class="text-2xl font-bold text-purple-600">{{ number_format($magang->total_skor * 10, 0) }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Overall Rank</p>
                        <p class="text-2xl font-bold text-yellow-600">#{{ $magang->rank }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-sm text-gray-600">Performance</p>
                        <p class="text-2xl font-bold text-green-600">{{ number_format(($magang->total_skor / 5) * 100, 1) }}%</p>
                    </div>
                </div>

                @if(isset($weeklyScores) && count($weeklyScores) > 0)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-2">Weekly Performance:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($weeklyScores as $week => $score)
                            <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full font-medium">
                                <i class="fas fa-calendar-week mr-1"></i>
                                Week {{ $week }}: {{ number_format($score['total'] * 10, 0) }}/50
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Week tabs functionality
            document.querySelectorAll('.week-tab').forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Hide all panels
                    document.querySelectorAll('.week-panel').forEach(panel => {
                        panel.classList.add('hidden');
                    });

                    // Remove active class from all tabs
                    document.querySelectorAll('.week-tab').forEach(t => {
                        t.classList.remove('bg-gradient-to-r', 'from-indigo-500', 'to-purple-600', 'text-white', 'border-indigo-500');
                        t.classList.add('text-indigo-600', 'hover:text-indigo-800', 'bg-white', 'hover:bg-indigo-50', 'border-gray-300');
                    });

                    // Show the selected panel
                    const targetId = this.getAttribute('data-target');
                    document.getElementById(targetId).classList.remove('hidden');

                    // Add active class to clicked tab
                    this.classList.remove('text-indigo-600', 'hover:text-indigo-800', 'bg-white', 'hover:bg-indigo-50', 'border-gray-300');
                    this.classList.add('bg-gradient-to-r', 'from-indigo-500', 'to-purple-600', 'text-white', 'border-indigo-500');
                });
            });

            // Weekly evaluations accordion
            document.querySelectorAll('.week-header').forEach(header => {
                header.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const chevron = this.querySelector('.week-chevron');

                    // Toggle content visibility
                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        chevron.style.transform = 'rotate(180deg)';
                    } else {
                        content.classList.add('hidden');
                        chevron.style.transform = 'rotate(0)';
                    }
                });
            });

            // Auto-expand the latest week
            const weekHeaders = document.querySelectorAll('.week-header');
            if (weekHeaders.length > 0) {
                weekHeaders[weekHeaders.length - 1].click();
            }

            // Animate elements on load
            const animatedElements = document.querySelectorAll('.transform');
            animatedElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });
    </script>
</x-app-layout>