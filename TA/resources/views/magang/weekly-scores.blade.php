<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-chart-line text-indigo-600 mr-2"></i>
                Weekly Scores for {{ $magang->pelamar->nama }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('magang.show', $magang->magang_id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-user-graduate mr-2"></i> Intern Details
                </a>
                <a href="{{ route('magang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Intern Header Card -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg mb-6 overflow-hidden">
                <div class="p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-16 w-16 rounded-full bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center text-white text-2xl font-bold mr-4 shadow-lg">
                                {{ substr($magang->pelamar->nama, 0, 1) }}
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold mb-1">{{ $magang->pelamar->nama }}</h1>
                                <p class="text-indigo-100 flex items-center">
                                    <i class="fas {{ $magang->pelamar->job->job_id == 'JOB001' ? 'fa-utensils' : 'fa-birthday-cake' }} mr-2"></i>
                                    {{ $magang->pelamar->job->nama_job ?? 'Unknown Position' }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg px-4 py-3">
                                <p class="text-sm text-indigo-100">Overall Score</p>
                                <p class="text-2xl font-bold">{{ number_format($magang->total_skor, 2) }}/5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weekly Scores Summary -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 border border-gray-200">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-chart-bar text-white mr-2"></i> Weekly Performance Summary
                    </h3>
                    <p class="text-green-100 text-sm mt-1">Track progress across evaluation weeks</p>
                </div>
                <div class="p-6">
                    @if(!empty($weeklyTotalScores) && count($weeklyTotalScores) > 0)
                        <!-- Statistics Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm p-4 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <div class="flex items-center">
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600 mr-4">
                                        <i class="fas fa-calendar-week text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Total Weeks</p>
                                        <p class="text-2xl font-semibold text-gray-800">{{ count($weeklyTotalScores) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-lg shadow-sm p-4 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <div class="flex items-center">
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                                        <i class="fas fa-arrow-up text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Highest Score</p>
                                        <p class="text-2xl font-semibold text-gray-800">{{ number_format(collect($weeklyTotalScores)->max('total_skor'), 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-orange-50 to-red-50 border border-orange-100 rounded-lg shadow-sm p-4 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <div class="flex items-center">
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-orange-100 text-orange-600 mr-4">
                                        <i class="fas fa-arrow-down text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Lowest Score</p>
                                        <p class="text-2xl font-semibold text-gray-800">{{ number_format(collect($weeklyTotalScores)->min('total_skor'), 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 rounded-lg shadow-sm p-4 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <div class="flex items-center">
                                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-purple-100 text-purple-600 mr-4">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Average Score</p>
                                        <p class="text-2xl font-semibold text-gray-800">{{ number_format(collect($weeklyTotalScores)->avg('total_skor'), 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Weekly Scores Table -->
                        <div class="overflow-x-auto bg-gray-50 rounded-lg mb-6">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-100 to-gray-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-calendar-week text-gray-400 mr-2"></i> Week
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-star text-gray-400 mr-2"></i> Total Score (0-5)
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-chart-bar text-gray-400 mr-2"></i> Scaled Score (0-50)
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-eye text-gray-400 mr-2"></i> Performance
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($weeklyTotalScores as $weekScore)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-800 text-sm font-bold mr-3">
                                                        {{ $weekScore->minggu_ke }}
                                                    </span>
                                                    <span class="text-sm font-medium text-gray-900">Week {{ $weekScore->minggu_ke }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-lg font-bold text-indigo-600 mr-3">{{ number_format($weekScore->total_skor, 2) }}</span>
                                                    <span class="text-sm text-gray-500">/ 5.00</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-lg font-bold text-purple-600 mr-3">{{ number_format($weekScore->total_skor * 10, 0) }}</span>
                                                    <span class="text-sm text-gray-500">/ 50</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-full bg-gray-200 rounded-full h-3 mr-3" style="min-width: 100px;">
                                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full transition-all duration-500 relative"
                                                             style="width: {{ ($weekScore->total_skor/5)*100 }}%;">
                                                            <span class="absolute right-0 top-0 h-3 w-3 bg-white rounded-full border-2 border-indigo-600"></span>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-900">{{ number_format(($weekScore->total_skor/5)*100, 1) }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gradient-to-r from-indigo-50 to-purple-50">
                                    <tr>
                                        <td class="px-6 py-4 font-bold text-indigo-900 flex items-center">
                                            <i class="fas fa-calculator text-indigo-600 mr-2"></i> Average Performance
                                        </td>
                                        <td class="px-6 py-4 font-bold text-indigo-700">
                                            {{ number_format(collect($weeklyTotalScores)->avg('total_skor'), 2) }}
                                        </td>
                                        <td class="px-6 py-4 font-bold text-purple-700">
                                            {{ number_format(collect($weeklyTotalScores)->avg('total_skor') * 10, 0) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="w-full bg-gray-200 rounded-full h-3">
                                                <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-3 rounded-full"
                                                     style="width: {{ (collect($weeklyTotalScores)->avg('total_skor')/5)*100 }}%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Progress Chart -->
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-lg border border-indigo-100">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-chart-line text-indigo-600 mr-2"></i> Performance Trend Analysis
                            </h4>
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <canvas id="weeklyScoresChart" width="400" height="200"></canvas>
                            </div>

                            <!-- Performance Insights -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                @php
                                    $scores = collect($weeklyTotalScores)->pluck('total_skor')->toArray();
                                    $trend = count($scores) > 1 ? ($scores[count($scores)-1] - $scores[0]) : 0;
                                    $isImproving = $trend > 0;
                                    $consistency = count($scores) > 1 ? 1 - (collect($scores)->values()->zip(collect($scores)->values()->skip(1))->map(function($pair) {
                                        return abs($pair[1] - $pair[0]);
                                    })->avg() ?? 0) : 1;
                                @endphp

                                <div class="bg-white p-4 rounded-lg border {{ $isImproving ? 'border-green-200' : 'border-orange-200' }} transform transition duration-200 hover:-translate-y-1">
                                    <div class="flex items-center">
                                        <div class="rounded-full h-10 w-10 flex items-center justify-center {{ $isImproving ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }} mr-3">
                                            <i class="fas {{ $isImproving ? 'fa-trending-up' : 'fa-trending-down' }}"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Performance Trend</p>
                                            <p class="font-medium {{ $isImproving ? 'text-green-700' : 'text-orange-700' }}">
                                                {{ $isImproving ? 'Improving' : 'Needs Attention' }}
                                                <span class="text-xs">({{ $trend > 0 ? '+' : '' }}{{ number_format($trend, 2) }})</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-4 rounded-lg border border-blue-200 transform transition duration-200 hover:-translate-y-1">
                                    <div class="flex items-center">
                                        <div class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-100 text-blue-600 mr-3">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Consistency Level</p>
                                            <p class="font-medium text-blue-700">
                                                {{ $consistency > 0.8 ? 'Very Consistent' : ($consistency > 0.6 ? 'Moderately Consistent' : 'Variable') }}
                                                <span class="text-xs">({{ number_format($consistency * 100, 0) }}%)</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-chart-line text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 text-xl mb-2">No weekly scores recorded yet</p>
                            <p class="text-gray-400">Complete evaluations to see performance trends</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recommendations Section -->
            @if(!empty($weeklyTotalScores) && count($weeklyTotalScores) > 0)
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-200">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-lightbulb text-white mr-2"></i> Performance Recommendations
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $avgScore = collect($weeklyTotalScores)->avg('total_skor');
                            $latestScore = collect($weeklyTotalScores)->last()->total_skor;
                        @endphp

                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-lg border border-blue-200">
                            <h4 class="font-semibold text-blue-900 mb-3 flex items-center">
                                <i class="fas fa-target text-blue-600 mr-2"></i> Performance Analysis
                            </h4>
                            @if($avgScore >= 4.0)
                                <p class="text-sm text-blue-700 mb-2">✅ <strong>Excellent Performance:</strong> Consistently scoring above 4.0</p>
                                <p class="text-sm text-blue-700">Continue maintaining this high standard and consider mentoring other interns.</p>
                            @elseif($avgScore >= 3.0)
                                <p class="text-sm text-blue-700 mb-2">👍 <strong>Good Performance:</strong> Solid average performance</p>
                                <p class="text-sm text-blue-700">Focus on consistency and aim for scores above 4.0 in upcoming evaluations.</p>
                            @else
                                <p class="text-sm text-blue-700 mb-2">⚠️ <strong>Needs Improvement:</strong> Below expected performance</p>
                                <p class="text-sm text-blue-700">Consider additional training and more frequent feedback sessions.</p>
                            @endif
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-lg border border-green-200">
                            <h4 class="font-semibold text-green-900 mb-3 flex items-center">
                                <i class="fas fa-chart-line text-green-600 mr-2"></i> Next Steps
                            </h4>
                            @if($isImproving)
                                <p class="text-sm text-green-700 mb-2">📈 <strong>Positive Trend:</strong> Performance is improving</p>
                                <p class="text-sm text-green-700">Keep up the good work and maintain this upward trajectory.</p>
                            @else
                                <p class="text-sm text-green-700 mb-2">📊 <strong>Focus Areas:</strong> Performance needs attention</p>
                                <p class="text-sm text-green-700">Identify specific areas for improvement and create an action plan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @if(!empty($weeklyTotalScores))
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize animations
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

            // Chart setup
            const ctx = document.getElementById('weeklyScoresChart').getContext('2d');

            // Prepare data for chart
            const weeks = [];
            const scores = [];
            const colors = [];

            @foreach($weeklyTotalScores as $weekScore)
                weeks.push('Week {{ $weekScore->minggu_ke }}');
                scores.push({{ $weekScore->total_skor }});

                // Color coding based on score
                @if($weekScore->total_skor >= 4.0)
                    colors.push('rgba(34, 197, 94, 0.8)'); // Green
                @elseif($weekScore->total_skor >= 3.0)
                    colors.push('rgba(59, 130, 246, 0.8)'); // Blue
                @elseif($weekScore->total_skor >= 2.0)
                    colors.push('rgba(245, 158, 11, 0.8)'); // Yellow
                @else
                    colors.push('rgba(239, 68, 68, 0.8)'); // Red
                @endif
            @endforeach

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: weeks,
                    datasets: [{
                        label: 'Weekly Total Score',
                        data: scores,
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 3,
                        pointBackgroundColor: colors,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Weekly Performance Progress',
                            font: {
                                size: 16,
                                weight: 'bold'
                            },
                            color: '#374151'
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 12
                                },
                                color: '#6B7280'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: 'rgba(99, 102, 241, 1)',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    return `Score: ${context.parsed.y.toFixed(2)}/5.0 (${(context.parsed.y * 10).toFixed(0)}/50)`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            title: {
                                display: true,
                                text: 'Score (0-5 scale)',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                },
                                color: '#374151'
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                color: '#6B7280'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Evaluation Week',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                },
                                color: '#374151'
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                color: '#6B7280'
                            }
                        }
                    },
                    elements: {
                        point: {
                            hoverBackgroundColor: 'rgba(99, 102, 241, 1)',
                            hoverBorderColor: '#ffffff'
                        }
                    }
                }
            });

            // Animate progress bars
            setTimeout(() => {
                const progressBars = document.querySelectorAll('[style*="width"]');
                progressBars.forEach(bar => {
                    const targetWidth = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = targetWidth;
                    }, 100);
                });
            }, 500);
        });
    </script>
    @endif
</x-app-layout>