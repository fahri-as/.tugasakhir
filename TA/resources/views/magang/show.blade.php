<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $magang->pelamar->nama }} - Internship Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex space-x-2">
                            <a href="{{ route('magang.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                            <a href="{{ route('magang.edit', $magang) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            @if($magang->pelamar && $magang->pelamar->job_id &&
                                in_array($magang->pelamar->job_id, ['JOB001', 'JOB004']))
                                <a href="{{ route('magang.weeklyScores', $magang) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Weekly Total Scores
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Basic Information Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="bg-gray-100 px-4 py-2 border-b">
                                <h2 class="font-semibold text-lg">Intern Information</h2>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Full Name</p>
                                        <p class="font-medium">{{ $magang->pelamar->nama }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Position</p>
                                        <p class="font-medium">{{ $magang->pelamar->job->nama_job ?? 'Not assigned' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Status</p>
                                        <p>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                {{ $magang->status_seleksi === 'Sedang Berjalan' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $magang->status_seleksi === 'Lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $magang->status_seleksi === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $magang->status_seleksi === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                                {{ $magang->status_seleksi }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Period</p>
                                        <p class="font-medium">{{ $magang->pelamar->periode->nama_periode ?? 'Not assigned' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Start Date</p>
                                        <p class="font-medium">
                                            @if($magang->jadwal_mulai)
                                                {{ $magang->jadwal_mulai->format('d M Y') }}
                                            @else
                                                Not scheduled
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Contact</p>
                                        <p class="font-medium">{{ $magang->pelamar->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SMART Score Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="bg-gray-100 px-4 py-2 border-b">
                                <h2 class="font-semibold text-lg">SMART Evaluation Results</h2>
                            </div>
                            <div class="p-4">
                                @if(in_array($magang->pelamar->job_id ?? '', ['JOB001', 'JOB004']))
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Overall Score</p>
                                            <p class="text-2xl font-bold">{{ number_format($magang->total_skor, 2) }}/5</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Ranking</p>
                                            <p class="text-xl font-bold bg-indigo-100 text-indigo-800 rounded-full w-10 h-10 flex items-center justify-center">
                                                {{ $magang->rank ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600 mb-2">Method</p>
                                        <p class="text-sm">
                                            SMART (Simple Multi-Attribute Rating Technique) evaluation is used to assess interns based on multiple weighted criteria. Scores are normalized and weighted using criteria importance determined through AHP.
                                        </p>
                                    </div>
                                @else
                                    <div class="py-8 text-center">
                                        <p class="text-gray-500">SMART evaluation is only available for Cook and Pastry Chef positions.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Scores Tab Section -->
                    @if(in_array($magang->pelamar->job_id ?? '', ['JOB001', 'JOB004']) && $weeklyScores && count($weeklyScores) > 0)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                        <div class="bg-gray-100 px-4 py-2 border-b">
                            <h2 class="font-semibold text-lg">Weekly SMART Scores</h2>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <ul class="flex border-b">
                                    @foreach($weeklyScores as $week => $score)
                                    <li class="-mb-px mr-1">
                                        <a class="week-tab inline-block py-2 px-4 border-l border-t border-r rounded-t {{ $loop->first ? 'bg-indigo-500 text-white' : 'text-blue-500 hover:text-blue-800 bg-white' }}"
                                           href="#"
                                           data-target="week-{{ $week }}">
                                            Week {{ $week }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="weekly-content">
                                @foreach($weeklyScores as $week => $score)
                                <div id="week-{{ $week }}" class="week-panel {{ $loop->first ? 'block' : 'hidden' }}">
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Total Score</p>
                                            <p class="text-xl font-semibold">{{ number_format($score['total'], 4) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Rank</p>
                                            <p class="text-lg font-semibold bg-indigo-100 text-indigo-800 rounded-full w-8 h-8 flex items-center justify-center">
                                                {{ $score['rank'] ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h3 class="text-md font-medium mb-2">Criteria Scores</h3>
                                        <div class="space-y-3">
                                            @forelse($score['criteria'] as $criteriaName => $criteriaScore)
                                            <div>
                                                <div class="flex justify-between text-sm">
                                                    <span>{{ $criteriaName }}</span>
                                                    <span>{{ number_format($criteriaScore, 4) }}</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min($criteriaScore * 100, 100) }}%"></div>
                                                </div>
                                            </div>
                                            @empty
                                            <p class="text-gray-500 text-sm">No criteria scores available</p>
                                            @endforelse
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
                    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                        <div class="bg-gray-100 px-4 py-2 border-b">
                            <h2 class="font-semibold text-lg">Criteria Contribution Analysis</h2>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($criteriaContribution as $contribution)
                                <div class="bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h3 class="font-medium">{{ $contribution['name'] }}</h3>
                                            <p class="text-sm text-gray-500">{{ $contribution['code'] }}</p>
                                        </div>
                                        <div class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                            Weight: {{ number_format($contribution['weight'], 4) }}
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $contribution['percentage'] }}%"></div>
                                        </div>
                                        <div class="flex justify-between mt-1 text-xs text-gray-600">
                                            <span>Score: {{ number_format($contribution['total_contribution'], 4) }}</span>
                                            <span>{{ number_format($contribution['percentage'], 1) }}%</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-4 text-sm text-gray-500">
                                <p>The percentages above show how much each criterion contributes to the intern's overall SMART score. Higher percentages indicate criteria that have more influence on the final ranking.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Weekly Evaluations Section -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                        <div class="bg-gray-100 px-4 py-2 border-b flex justify-between items-center">
                            <h2 class="font-semibold text-lg">Weekly Evaluations</h2>
                            @if($magang->status_seleksi === 'Sedang Berjalan')
                            <a href="{{ route('evaluasi.create', ['magang_id' => $magang->magang_id]) }}"
                               class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold py-1 px-3 rounded">
                                Add Evaluation
                            </a>
                            @endif
                        </div>
                        <div class="p-4">
                            @if($evaluationsByWeek->count() > 0)
                            <div class="space-y-4" id="accordion">
                                @foreach($evaluationsByWeek->sortKeys() as $week => $evaluations)
                                <div class="border rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 cursor-pointer flex justify-between items-center week-header" data-week="{{ $week }}">
                                        <div class="font-medium">Week {{ $week }}</div>
                                        <div class="flex items-center">
                                            <span class="mr-2">{{ $evaluations->count() }} evaluations</span>
                                            <svg class="h-5 w-5 week-chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="week-content hidden p-4">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                                                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($evaluations as $evaluation)
                                                    <tr>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            @if($evaluation->criteria)
                                                                <div class="font-medium">{{ $evaluation->criteria->name }}</div>
                                                                <div class="text-sm text-gray-500">{{ $evaluation->criteria->code }}</div>
                                                            @else
                                                                <span class="text-gray-500 italic">No specific criteria</span>
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap">
                                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                                {{ $evaluation->ratingScale->name ?? 'N/A' }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap font-medium">
                                                            {{ number_format($evaluation->skor_minggu, 2) }}
                                                        </td>
                                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                                            <a href="{{ route('evaluasi.edit', $evaluation) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                            <a href="{{ route('evaluasi.show', $evaluation) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="bg-gray-50">
                                                        <td colspan="2" class="px-4 py-3 text-sm font-medium text-gray-900">Week Total</td>
                                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">
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
                            <div class="py-8 text-center">
                                <p class="text-gray-500">No evaluations have been recorded yet.</p>
                                @if($magang->status_seleksi === 'Sedang Berjalan')
                                <a href="{{ route('evaluasi.create', ['magang_id' => $magang->magang_id]) }}"
                                   class="mt-2 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                    Create First Evaluation
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <form action="{{ route('magang.updateStatus', $magang) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            @if($magang->status_seleksi === 'Sedang Berjalan')
                                <input type="hidden" name="status_seleksi" value="Lulus">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                    Mark as Completed
                                </button>
                            @elseif($magang->status_seleksi === 'Pending')
                                <input type="hidden" name="status_seleksi" value="Sedang Berjalan">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                    Start Internship
                                </button>
                            @endif
                        </form>

                        <form action="{{ route('magang.destroy', $magang) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this internship record? This will also delete all associated evaluations.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                Delete Record
                            </button>
                        </form>

                        @if(in_array($magang->pelamar->job_id ?? '', ['JOB001', 'JOB004']))
                        <a href="{{ route('magang.smartDashboard', ['job_id' => $magang->pelamar->job_id]) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                            View SMART Dashboard
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- JavaScript for tabs and accordion -->
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
                    t.classList.remove('bg-indigo-500', 'text-white');
                    t.classList.add('text-blue-500', 'hover:text-blue-800', 'bg-white');
                });

                // Show the selected panel
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).classList.remove('hidden');

                // Add active class to clicked tab
                this.classList.remove('text-blue-500', 'hover:text-blue-800', 'bg-white');
                this.classList.add('bg-indigo-500', 'text-white');
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
    });
</script>
