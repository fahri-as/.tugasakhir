<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-comments text-indigo-600 mr-2"></i> {{ __('Interview Management') }}
            </h2>
            <a href="{{ route('interview.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-calendar-plus mr-2"></i> Schedule New Interview
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            @php
                $totalInterviews = $interviews->count();
                $pendingInterviews = $interviews->where('status_seleksi', 'Pending')->count();
                $failedInterviews = $interviews->where('status_seleksi', 'Tidak Lulus')->count();
                $passedInterviews = $interviews->where('status_seleksi', 'Tes Kemampuan')->count();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total Interviews -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-comments text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Interviews</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $totalInterviews }}</p>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Pending</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $pendingInterviews }}</p>
                    </div>
                </div>

                <!-- Failed -->
                <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-red-100 text-red-600 mr-4">
                        <i class="fas fa-times-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Failed</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $failedInterviews }}</p>
                    </div>
                </div>

                <!-- Passed -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Passed</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $passedInterviews }}</p>
                    </div>
                </div>
            </div>

            <!-- Main Content Container -->
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Period & Job Filter -->
                    <div class="mb-6 bg-gradient-to-r from-gray-50 to-blue-50 p-5 rounded-lg shadow-sm border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-filter text-indigo-600 mr-2"></i> Filter Interviews
                        </h3>
                        <form action="{{ route('interview.index') }}" method="GET" id="filter-form">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Period</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-alt text-gray-400"></i>
                                        </div>
                                        <select id="periode_filter" name="periode_id" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @php
                                                $latestPeriode = App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
                                                $latestPeriodeId = $latestPeriode ? $latestPeriode->periode_id : '';

                                                // Important fix: Handle "All Periods" correctly
                                                $selectedPeriodeId = $latestPeriodeId; // Default to latest

                                                if (request()->has('periode_id')) {
                                                    // When 'All Periods' is selected, request('periode_id') will be empty string
                                                    $selectedPeriodeId = request('periode_id');
                                                }

                                                $sortBy = request('sort_by', 'total_skor');
                                                $sortDir = request('sort_dir', 'desc');
                                                $selectedJobs = request('jobs', []);
                                            @endphp
                                            <option value="" {{ $selectedPeriodeId === '' ? 'selected' : '' }}>All Periods</option>
                                            @foreach(App\Models\Periode::orderBy('tanggal_mulai', 'desc')->get() as $periode)
                                                <option value="{{ $periode->periode_id }}" {{ $selectedPeriodeId == $periode->periode_id ? 'selected' : '' }}>
                                                    {{ $periode->nama_periode }} ({{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Job Filter -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Position</label>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 p-3 bg-white rounded-md max-h-40 overflow-y-auto border border-gray-200">
                                        @php
                                            // Debug the selected period ID to understand what value we're working with
                                            // dd($selectedPeriodeId); // Uncomment to check value if needed

                                            // Modified logic to get jobs for selected period or ALL jobs if no period selected
                                            if ($selectedPeriodeId !== '' && $selectedPeriodeId !== null) {
                                                // Get jobs for a specific period
                                                $jobs = App\Models\Job::whereHas('periodes', function($query) use ($selectedPeriodeId) {
                                                    $query->where('periode.periode_id', $selectedPeriodeId);
                                                })->orderBy('nama_job')->get();
                                            } else {
                                                // Get ALL jobs from all periods when "All Periods" is selected
                                                $jobs = App\Models\Job::whereHas('periodes')->orderBy('nama_job')->get();
                                            }

                                            // Make sure we have results
                                            // dd($jobs->count()); // Uncomment to check if jobs are returned
                                        @endphp

                                        @foreach($jobs as $job)
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="job_{{ $job->job_id }}" name="jobs[]" type="checkbox" value="{{ $job->job_id }}"
                                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                        {{ in_array($job->job_id, (array)$selectedJobs) ? 'checked' : '' }}>
                                                </div>
                                                <div class="ml-2 text-sm">
                                                    <label for="job_{{ $job->job_id }}" class="font-medium text-gray-700">{{ $job->nama_job }}</label>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if(count($jobs) == 0)
                                            <div class="text-sm text-gray-500 italic col-span-full">
                                                No jobs available for this period.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm hover:shadow">
                                    <i class="fas fa-search mr-2"></i> Apply Filters
                                </button>

                                @if(request()->has('periode_id') || request()->has('sort_by') || !empty($selectedJobs))
                                    <a href="{{ route('interview.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-undo mr-2"></i> Reset Filters
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Table Container -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'interview_id', 'sort_dir' => $sortBy == 'interview_id' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                            No
                                            @if($sortBy == 'interview_id')
                                                @if($sortDir == 'asc')
                                                    <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                @else
                                                    <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'pelamar_nama', 'sort_dir' => $sortBy == 'pelamar_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                            Applicant
                                            @if($sortBy == 'pelamar_nama')
                                                @if($sortDir == 'asc')
                                                    <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                @else
                                                    <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'job_nama', 'sort_dir' => $sortBy == 'job_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                            Job Position
                                            @if($sortBy == 'job_nama')
                                                @if($sortDir == 'asc')
                                                    <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                @else
                                                    <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'periode_nama', 'sort_dir' => $sortBy == 'periode_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                            Period
                                            @if($sortBy == 'periode_nama')
                                                @if($sortDir == 'asc')
                                                    <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                @else
                                                    <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'jadwal', 'sort_dir' => $sortBy == 'jadwal' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                            Schedule
                                            @if($sortBy == 'jadwal')
                                                @if($sortDir == 'asc')
                                                    <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                @else
                                                    <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'total_skor', 'sort_dir' => $sortBy == 'total_skor' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                            Total Score
                                            @if($sortBy == 'total_skor' || (!request('sort_by') && !request('sort_dir')))
                                                @if($sortDir == 'asc')
                                                    <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                @else
                                                    <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($interviews as $interview)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $interview->pelamar->nama }}</div>
                                            <div class="text-xs text-gray-500">{{ $interview->pelamar->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $interview->pelamar->job->nama_job }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $interview->pelamar->periode->nama_periode }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <i class="far fa-calendar-alt text-indigo-500 mr-1"></i>
                                                <span class="text-sm text-gray-900">{{ $interview->jadwal->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="far fa-clock text-indigo-500 mr-1"></i>
                                                <span class="text-sm text-gray-500">{{ $interview->jadwal->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="h-4 w-full bg-gray-200 rounded-full overflow-hidden">
                                                @php
                                                    $scorePercentage = ($interview->total_skor / 5) * 100;
                                                    $scoreColor = 'bg-red-500';
                                                    if ($scorePercentage >= 80) {
                                                        $scoreColor = 'bg-green-500';
                                                    } elseif ($scorePercentage >= 60) {
                                                        $scoreColor = 'bg-blue-500';
                                                    } elseif ($scorePercentage >= 40) {
                                                        $scoreColor = 'bg-yellow-500';
                                                    }
                                                @endphp
                                                <div class="{{ $scoreColor }}" style="width: {{ $scorePercentage }}%; height: 100%"></div>
                                            </div>
                                            <div class="text-xs text-center mt-1 font-semibold">
                                                {{ number_format($interview->total_skor, 2) }}/5
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($interview->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                                @if($interview->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                                @if($interview->status_seleksi === 'Tes Kemampuan') bg-green-100 text-green-800 @endif">
                                                <i class="fas
                                                    @if($interview->status_seleksi === 'Pending') fa-clock @endif
                                                    @if($interview->status_seleksi === 'Tidak Lulus') fa-times-circle @endif
                                                    @if($interview->status_seleksi === 'Tes Kemampuan') fa-check-circle @endif
                                                    mr-1"></i>
                                                {{ $interview->status_seleksi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex space-x-2 justify-end">
                                                <a href="{{ route('interview.show', $interview) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('interview.edit', $interview) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('interview.destroy', $interview) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this interview?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                                <div class="flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm text-yellow-700">
                                                            No interviews found. Try adjusting your filters or <a href="{{ route('interview.create') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">schedule a new interview</a>.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        @if(method_exists($interviews, 'links'))
                            {{ $interviews->appends(request()->except('page'))->links() }}
                        @endif
                    </div>

                    <!-- JavaScript for dynamic period/job filtering -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const periodeFilter = document.getElementById('periode_filter');

                            periodeFilter.addEventListener('change', function() {
                                document.getElementById('filter-form').submit();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
