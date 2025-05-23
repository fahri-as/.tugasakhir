<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-clipboard-check text-indigo-600 mr-2"></i> {{ __('Evaluation Details') }}
            </h2>
            <a href="{{ route('evaluasi.index', ['periode_id' => $evaluasi->magang->pelamar->periode_id ?? '']) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Evaluation Header Card -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg mb-6 overflow-hidden">
                <div class="p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">{{ $evaluasi->magang->pelamar->nama }}</h1>
                            <p class="text-indigo-100 flex items-center">
                                <i class="fas fa-briefcase mr-2"></i>
                                {{ $evaluasi->magang->pelamar->job->nama_job ?? 'Not assigned' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-4 py-2 mb-2">
                                <span class="text-sm">Week</span>
                                <p class="text-2xl font-bold">{{ $evaluasi->minggu_ke }}</p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-300 mr-1"></i>
                                <span class="text-2xl font-bold">
                                    {{ $evaluasi->criteria_rating_id ? number_format($evaluasi->skor_minggu * 10, 0) : 'N/A' }}
                                </span>
                                <span class="text-sm ml-1">/5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Evaluation Information Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-indigo-100">
                        <h2 class="font-semibold text-lg flex items-center">
                            <i class="fas fa-clipboard-list text-indigo-600 mr-2"></i> Evaluation Details
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-hashtag text-gray-400 mr-2"></i> ID
                                </span>
                                <span class="font-medium text-gray-900">{{ $evaluasi->evaluasi_id }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-calendar-week text-gray-400 mr-2"></i> Week
                                </span>
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium">
                                    Week {{ $evaluasi->minggu_ke }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-clock text-gray-400 mr-2"></i> Created
                                </span>
                                <span class="text-sm text-gray-900">{{ $evaluasi->created_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Criteria & Rating Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-100">
                        <h2 class="font-semibold text-lg flex items-center">
                            <i class="fas fa-tasks text-purple-600 mr-2"></i> Criteria & Rating
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($evaluasi->criteria)
                            <div class="mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded">
                                        {{ $evaluasi->criteria->code }}
                                    </span>
                                    <span class="text-xs text-gray-500">Weight: {{ number_format($evaluasi->criteria->weight, 2) }}</span>
                                </div>
                                <h3 class="font-medium text-gray-900 mb-1">{{ $evaluasi->criteria->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $evaluasi->criteria->description }}</p>
                            </div>

                            <div class="border-t pt-4">
                                <p class="text-sm text-gray-600 mb-2">Rating</p>
                                @if($evaluasi->criteria_rating_id)
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-3 rounded-lg border border-green-100">
                                        <p class="font-medium text-green-800">{{ $evaluasi->criteriaRatingScale->name ?? 'N/A' }}</p>
                                        <p class="text-sm text-green-600">Level: {{ $evaluasi->criteriaRatingScale->rating_level ?? 'N/A' }}</p>
                                    </div>
                                @else
                                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                        <p class="text-gray-500 italic">Not Rated Yet</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-inbox text-gray-300 text-4xl mb-2"></i>
                                <p class="text-gray-500">No specific criteria assigned</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Intern Status Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-green-100">
                        <h2 class="font-semibold text-lg flex items-center">
                            <i class="fas fa-user-graduate text-green-600 mr-2"></i> Intern Status
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <div class="w-20 h-20 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-2xl font-bold">
                                {{ substr($evaluasi->magang->pelamar->nama, 0, 1) }}
                            </div>
                            <h3 class="font-medium text-gray-900">{{ $evaluasi->magang->pelamar->nama }}</h3>
                            <p class="text-sm text-gray-600">ID: {{ $evaluasi->magang->magang_id }}</p>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status</span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $evaluasi->magang->status_seleksi === 'Sedang Berjalan' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $evaluasi->magang->status_seleksi === 'Lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $evaluasi->magang->status_seleksi === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $evaluasi->magang->status_seleksi === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                    {{ $evaluasi->magang->status_seleksi }}
                                </span>
                            </div>
                            <a href="{{ route('magang.show', $evaluasi->magang) }}" class="block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 px-4 rounded-md hover:from-indigo-600 hover:to-purple-700 transition duration-150 transform hover:scale-105 text-sm font-medium">
                                <i class="fas fa-external-link-alt mr-1"></i> View Full Intern Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SMART Analysis Section (Enhanced) -->
            @if($evaluasi->magang &&
                $evaluasi->magang->pelamar &&
                $evaluasi->magang->pelamar->job_id &&
                in_array($evaluasi->magang->pelamar->job_id, ['JOB001', 'JOB004']) &&
                $smartDetails)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold text-xl text-white flex items-center">
                                <i class="fas fa-brain text-white mr-2"></i> SMART Analysis
                            </h2>
                            <p class="text-indigo-100 text-sm">
                                Simple Multi-Attribute Rating Technique for {{ $evaluasi->magang->pelamar->job->nama_job }}
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-6 py-3">
                            <div class="text-center">
                                <p class="text-xs text-indigo-100 uppercase tracking-wider">Rank</p>
                                <p class="text-3xl font-bold text-white">#{{ $smartDetails['rank'] }}</p>
                                <p class="text-xs text-indigo-100">Score: {{ number_format($smartDetails['total_score'], 4) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- SMART Score Visualization -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Score Breakdown Chart -->
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-lg border border-indigo-100">
                            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-chart-pie text-indigo-600 mr-2"></i> Score Breakdown
                            </h3>
                            <div class="space-y-3">
                                @foreach($smartDetails['score_details'] as $detail)
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="font-medium">{{ $detail['criteria_code'] }} - {{ $detail['criteria_name'] }}</span>
                                        <span class="text-indigo-700 font-semibold">{{ number_format($detail['weighted_score'], 4) }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full transition-all duration-500"
                                             style="width: {{ ($detail['weighted_score'] / $smartDetails['total_score']) * 100 }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Performance Metrics -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-lg border border-purple-100">
                            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-tachometer-alt text-purple-600 mr-2"></i> Performance Metrics
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white p-4 rounded-lg text-center transform transition duration-200 hover:-translate-y-1">
                                    <i class="fas fa-percentage text-indigo-500 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-600">Normalized Score</p>
                                    <p class="text-xl font-bold text-gray-900">{{ number_format($smartDetails['total_score'] * 100, 1) }}%</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg text-center transform transition duration-200 hover:-translate-y-1">
                                    <i class="fas fa-star text-yellow-500 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-600">5-Scale Rating</p>
                                    <p class="text-xl font-bold text-gray-900">{{ number_format($smartDetails['total_score'] * 5, 2) }}/5</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Calculation Table -->
                    <div class="overflow-x-auto bg-white rounded-lg border">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Raw Score</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Normalized</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Weighted Score</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($smartDetails['score_details'] as $detail)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded mr-2">
                                                {{ $detail['criteria_code'] }}
                                            </span>
                                            <span class="text-sm text-gray-900">{{ $detail['criteria_name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-1.5 mr-2">
                                                <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $detail['weight'] * 100 }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-900">{{ number_format($detail['weight'], 4) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                        {{ number_format($detail['raw_value'], 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                        {{ number_format($detail['normalized_value'], 4) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 text-sm font-semibold rounded-full">
                                            {{ number_format($detail['weighted_score'], 4) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="bg-gradient-to-r from-indigo-50 to-purple-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-900" colspan="4">
                                        <i class="fas fa-calculator mr-2"></i> Total Score
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-bold rounded-full">
                                            {{ number_format($smartDetails['total_score'], 4) }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Calculation Methodology (Collapsible) -->
                    <div class="mt-6">
                        <button onclick="toggleMethodology()" class="w-full bg-gradient-to-r from-indigo-50 to-purple-50 p-4 rounded-lg border border-indigo-100 hover:from-indigo-100 hover:to-purple-100 transition duration-150 flex items-center justify-between">
                            <span class="font-semibold text-indigo-900 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i> View Detailed Calculation Steps
                            </span>
                            <i id="methodology-chevron" class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                        </button>

                        <div id="methodology-content" class="hidden mt-4 space-y-4">
                            <!-- Calculation steps content (same as before but with enhanced styling) -->
                            @if($actualCalculation && $actualCalculation['has_data'])
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <!-- Step 1 -->
                                <div class="bg-white p-6 rounded-lg border border-gray-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-indigo-600 font-bold">1</span>
                                        </div>
                                        <h4 class="font-semibold text-gray-800">Data Collection</h4>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Raw scores from evaluations:</p>
                                    <div class="bg-gray-50 p-3 rounded">
                                        <table class="min-w-full text-xs">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Criteria</th>
                                                    <th class="text-right">Score</th>
                                                    <th class="text-right">Weight</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($actualCalculation['criteria'] as $criterion)
                                                <tr>
                                                    <td>{{ $criterion['criteria_code'] }}</td>
                                                    <td class="text-right">{{ $criterion['raw_score'] }}</td>
                                                    <td class="text-right">{{ number_format($criterion['weight'], 4) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="bg-white p-6 rounded-lg border border-gray-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-purple-600 font-bold">2</span>
                                        </div>
                                        <h4 class="font-semibold text-gray-800">Normalization</h4>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Convert to 0-1 scale:</p>
                                    <div class="bg-gray-50 p-3 rounded">
                                        <code class="text-xs block mb-2">Normalized = (Value - Min) / (Max - Min)</code>
                                        @foreach($actualCalculation['criteria'] as $criterion)
                                        <div class="text-xs mb-1">
                                            <span class="font-medium">{{ $criterion['criteria_code'] }}:</span>
                                            {{ $criterion['calculation'] }} = {{ number_format($criterion['normalized'], 4) }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="bg-white p-6 rounded-lg border border-gray-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-green-600 font-bold">3</span>
                                        </div>
                                        <h4 class="font-semibold text-gray-800">Weighted Calculation</h4>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Apply criteria weights:</p>
                                    <div class="bg-gray-50 p-3 rounded">
                                        <code class="text-xs block mb-2">Weighted = Normalized × Weight</code>
                                        @foreach($actualCalculation['criteria'] as $criterion)
                                        <div class="text-xs mb-1">
                                            <span class="font-medium">{{ $criterion['criteria_code'] }}:</span>
                                            {{ $criterion['weighted_calculation'] }} = {{ number_format($criterion['weighted'], 4) }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="bg-white p-6 rounded-lg border border-gray-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex items-center mb-3">
                                        <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-pink-600 font-bold">4</span>
                                        </div>
                                        <h4 class="font-semibold text-gray-800">Final Score</h4>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">Sum all weighted scores:</p>
                                    <div class="bg-gray-50 p-3 rounded">
                                        <p class="text-xs mb-2">{{ $actualCalculation['full_calculation'] }}</p>
                                        <div class="text-center mt-3">
                                            <p class="text-2xl font-bold text-indigo-600">{{ number_format($actualCalculation['total_score'], 4) }}</p>
                                            <p class="text-xs text-gray-500">SMART Score (0-1 scale)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Criteria Contribution Analysis (Enhanced) -->
            @if($criteriaContribution && count($criteriaContribution) > 0)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 px-6 py-4">
                    <h2 class="font-semibold text-lg text-white flex items-center">
                        <i class="fas fa-chart-bar text-white mr-2"></i> Criteria Contribution Analysis
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($criteriaContribution as $contribution)
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-4 border border-gray-200 transform transition duration-200 hover:-translate-y-1 hover:shadow-md">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $contribution['name'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $contribution['code'] }}</p>
                                </div>
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    {{ number_format($contribution['percentage'], 1) }}%
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span>Weight: {{ number_format($contribution['weight'], 3) }}</span>
                                    <span>Contribution: {{ number_format($contribution['total_contribution'], 3) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full transition-all duration-500"
                                         style="width: {{ $contribution['percentage'] }}%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-sm text-gray-700 flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                            This chart shows how much each criterion contributes to the intern's overall SMART score.
                            Higher percentages indicate criteria that have more influence on the final ranking.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('evaluasi.edit', $evaluasi) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-edit mr-2"></i> Edit Evaluation
                </a>

                <form action="{{ route('evaluasi.destroy', $evaluasi) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this evaluation?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </form>

                <a href="{{ route('magang.show', $evaluasi->magang) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-purple-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-user-graduate mr-2"></i> View All Evaluations
                </a>

                <button onclick="refreshSmartData()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-sync-alt mr-2"></i> Refresh Analysis
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle methodology content
        function toggleMethodology() {
            const content = document.getElementById('methodology-content');
            const chevron = document.getElementById('methodology-chevron');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }

        // Refresh SMART data function
        function refreshSmartData() {
            const csrfToken = '{{ csrf_token() }}';
            const evaluasiId = '{{ $evaluasi->evaluasi_id }}';
            const magangId = '{{ $evaluasi->magang_id }}';
            const weekNumber = {{ $evaluasi->minggu_ke }};

            // Show loading state
            const refreshBtn = event.target.closest('button');
            const originalContent = refreshBtn.innerHTML;
            refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Refreshing...';
            refreshBtn.disabled = true;

            // Make AJAX request
            fetch(`/api/evaluations?magang_id=${magangId}&week=${weekNumber}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                // Show success notification
                showNotification('SMART analysis refreshed successfully!', 'success');

                // Reload page after short delay
                setTimeout(() => {
                    location.reload();
                }, 1000);
            })
            .catch(error => {
                console.error('Error refreshing SMART data:', error);
                showNotification('Error refreshing SMART analysis', 'error');

                // Restore button
                refreshBtn.innerHTML = originalContent;
                refreshBtn.disabled = false;
            });
        }

        // Show notification function
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium shadow-lg transform transition-all duration-300 z-50 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                    ${message}
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Add animation on load
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
            const cards = document.querySelectorAll('.transform');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animate progress bars
            const progressBars = document.querySelectorAll('.bg-gradient-to-r');
            progressBars.forEach(bar => {
                if (bar.style.width) {
                    const targetWidth = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = targetWidth;
                    }, 500);
                }
            });
        });
    </script>
</x-app-layout>