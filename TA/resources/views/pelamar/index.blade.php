<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-user-friends text-indigo-600 mr-2"></i> {{ __('Applicant Management') }}
            </h2>
            <a href="{{ route('pelamar.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-plus-circle mr-2"></i> Create New Applicant
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
                // Total from the paginator
                $totalApplicants = $pelamar->total();

                // Create a query with the same filters as the controller
                $query = App\Models\Pelamar::query();

                // Apply the same filtering as in the controller
                if (request()->filled('periode_id')) {
                    $query->where('periode_id', request('periode_id'));
                } else if (request()->has('periode_id') && request('periode_id') === '') {
                    // Show all periods (don't filter)
                } else {
                    // Default to most recent period
                    $latestPeriode = App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
                    if ($latestPeriode) {
                        $query->where('periode_id', $latestPeriode->periode_id);
                    }
                }

                // Filter by selected jobs if jobs filter is applied
                if (request()->filled('jobs') && is_array(request('jobs'))) {
                    $query->whereIn('job_id', request('jobs'));
                }

                // Now get the filtered counts by status
                $pendingApplicants = (clone $query)->where('status_seleksi', 'Pending')->count();
                $interviewApplicants = (clone $query)->where('status_seleksi', 'Interview')->count();
                $inProgressApplicants = (clone $query)->where('status_seleksi', 'Sedang Berjalan')->count();
            @endphp

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total Applicants -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Applicants</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $totalApplicants }}</p>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Pending Review</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $pendingApplicants }}</p>
                    </div>
                </div>

                <!-- Interview -->
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-indigo-100 text-indigo-600 mr-4">
                        <i class="fas fa-user-tie text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">In Interview</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $interviewApplicants }}</p>
                    </div>
                </div>

                <!-- In Progress -->
                <div class="bg-gradient-to-r from-green-50 to-teal-50 border border-green-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-user-graduate text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">In Progress</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $inProgressApplicants }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md flex items-center transform transition-all duration-300 hover:bg-green-50" role="alert">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md flex items-center transform transition-all duration-300 hover:bg-red-50" role="alert">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Period & Job Filter -->
                    <div class="mb-6 bg-gradient-to-r from-gray-50 to-blue-50 p-5 rounded-lg shadow-sm border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-filter text-indigo-600 mr-2"></i> Filter Applications
                        </h3>
                        <form action="{{ route('pelamar.index') }}" method="GET" id="filter-form">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-calendar-alt text-gray-400"></i>
                                        </div>
                                        <select id="periode_filter" name="periode_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @php
                                                $latestPeriode = App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
                                                $latestPeriodeId = $latestPeriode ? $latestPeriode->periode_id : '';

                                                // Important fix: Handle "All Periods" correctly
                                                $selectedPeriodeId = $latestPeriodeId; // Default to latest

                                                if (request()->has('periode_id')) {
                                                    // When 'All Periods' is selected, request('periode_id') will be empty string
                                                    $selectedPeriodeId = request('periode_id');
                                                }

                                                $sortBy = request('sort_by', 'lama_pengalaman');
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
                                <div>
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
                                    <a href="{{ route('pelamar.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-undo mr-2"></i> Reset Filters
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    @if(count($pelamar) > 0)
                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'nama', 'sort_dir' => $sortBy == 'nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Name
                                                @if($sortBy == 'nama')
                                                    @if($sortDir == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'job_id', 'sort_dir' => request('sort_by') == 'job_id' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Job
                                                @if(request('sort_by') == 'job_id')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'periode_id', 'sort_dir' => request('sort_by') == 'periode_id' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Period
                                                @if(request('sort_by') == 'periode_id')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'pendidikan', 'sort_dir' => request('sort_by') == 'pendidikan' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Education
                                                @if(request('sort_by') == 'pendidikan')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'tgl_lahir', 'sort_dir' => request('sort_by') == 'tgl_lahir' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Birth Date
                                                @if(request('sort_by') == 'tgl_lahir')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $i = ($pelamar->currentPage() - 1) * $pelamar->perPage() + 1;
                                    @endphp
                                    @foreach($pelamar as $p)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $i++ }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $p->nama }}</div>
                                                <div class="text-xs text-gray-500">{{ $p->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($p->job)
                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $p->job->nama_job }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">Not assigned</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($p->periode)
                                                    {{ $p->periode->nama_periode }}
                                                @else
                                                    <span class="text-gray-400">Not assigned</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $p->pendidikan ?? 'Not specified' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $p->tgl_lahir ? $p->tgl_lahir->format('d M Y') : 'Not specified' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($p->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                                    @if($p->status_seleksi === 'Interview') bg-blue-100 text-blue-800 @endif
                                                    @if($p->status_seleksi === 'Sedang Berjalan') bg-green-100 text-green-800 @endif
                                                ">
                                                    {{ $p->status_seleksi ?? 'Pending' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex space-x-2 justify-end">
                                                    <a href="{{ route('pelamar.show', $p) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('pelamar.edit', $p) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('pelamar.destroy', $p) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this applicant?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $pelamar->appends(request()->except('page'))->links() }}
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        No applicant data found. Try adjusting your filters or <a href="{{ route('pelamar.create') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">add a new applicant</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const periodeFilter = document.getElementById('periode_filter');

            periodeFilter.addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });
    </script>
</x-app-layout>
