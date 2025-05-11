<x-crud-layout title="Skill Test Management" :createRoute="route('tes-kemampuan.create')">
    <!-- Period & Job Filter -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
        <form action="{{ route('tes-kemampuan.index') }}" method="GET" id="filter-form">
            <div class="mb-4">
                <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Period</label>
                <div class="flex items-end space-x-4">
                    <div class="flex-grow">
                        <select id="periode_filter" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @php
                                $latestPeriode = App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
                                $latestPeriodeId = $latestPeriode ? $latestPeriode->periode_id : '';
                                // Fix: Only set default to latest if explicitly not set in request
                                $selectedPeriodeId = request()->has('periode_id') ? request('periode_id') : $latestPeriodeId;
                                $sortBy = request('sort_by', 'skor');
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
            </div>

            <!-- Job Filter -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Job Position</label>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 p-3 bg-gray-50 rounded-md max-h-40 overflow-y-auto">
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

            <div class="flex items-center">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Apply Filters
                </button>

                @if(request()->has('periode_id') || request()->has('sort_by') || !empty($selectedJobs))
                    <a href="{{ route('tes-kemampuan.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Reset Filters
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('tes-kemampuan.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'tes_id', 'sort_dir' => $sortBy == 'tes_id' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            ID
                            @if($sortBy == 'tes_id')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('tes-kemampuan.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'pelamar_nama', 'sort_dir' => $sortBy == 'pelamar_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Applicant
                            @if($sortBy == 'pelamar_nama')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('tes-kemampuan.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'job_nama', 'sort_dir' => $sortBy == 'job_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Job Position
                            @if($sortBy == 'job_nama')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('tes-kemampuan.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'periode_nama', 'sort_dir' => $sortBy == 'periode_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Period
                            @if($sortBy == 'periode_nama')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('tes-kemampuan.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'jadwal', 'sort_dir' => $sortBy == 'jadwal' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Schedule
                            @if($sortBy == 'jadwal')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('tes-kemampuan.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'skor', 'sort_dir' => $sortBy == 'skor' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Score
                            @if($sortBy == 'skor' || (!request('sort_by') && !request('sort_dir')))
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('tes-kemampuan.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'status_seleksi', 'sort_dir' => $sortBy == 'status_seleksi' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Status
                            @if($sortBy == 'status_seleksi')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($tesKemampuan as $tes)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tes->tes_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tes->pelamar->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tes->pelamar->job->nama_job }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tes->pelamar->periode->nama_periode }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tes->jadwal->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $tes->skor }}/100</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($tes->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                @if($tes->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                @if($tes->status_seleksi === 'Lulus') bg-green-100 text-green-800 @endif
                                @if($tes->status_seleksi === 'Magang') bg-blue-100 text-blue-800 @endif">
                                {{ $tes->status_seleksi }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('tes-kemampuan.show', $tes) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                            <a href="{{ route('tes-kemampuan.edit', $tes) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('tes-kemampuan.destroy', $tes) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this test?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No skill tests found. Schedule your first test!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- JavaScript for dynamic period/job filtering -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to the period dropdown and form
            const periodeFilter = document.getElementById('periode_filter');
            const jobsContainer = document.querySelector('.grid');

            // Add event listener to period dropdown
            periodeFilter.addEventListener('change', function() {
                // Submit the form when period changes
                // This will reload the page with the new period filter
                document.getElementById('filter-form').submit();
            });
        });
    </script>
</x-crud-layout>
