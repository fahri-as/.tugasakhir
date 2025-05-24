<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-user-graduate text-indigo-600 mr-2"></i> {{ __('Internship Management') }}
            </h2>
            <a href="{{ route('magang.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                <i class="fas fa-plus-circle mr-2"></i> Create New Internship
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
                // Calculate statistics using the underlying query builder
                $totalInternships = $magang->total();
                $pendingInternships = $magang->where('status_seleksi', 'Pending')->count();
                $activeInternships = $magang->where('status_seleksi', 'Sedang Berjalan')->count();
                $completedInternships = $magang->where('status_seleksi', 'Lulus')->count();
                $rejectedInternships = $magang->where('status_seleksi', 'Tidak Lulus')->count();
            @endphp

            <!-- Enhanced Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                <!-- Total Internships -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Interns</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $totalInternships }}</p>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Pending</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $pendingInternships }}</p>
                    </div>
                </div>

                <!-- Active -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-play-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Active</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $activeInternships }}</p>
                    </div>
                </div>

                <!-- Completed -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Completed</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $completedInternships }}</p>
                    </div>
                </div>

                <!-- Rejected -->
                <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-red-100 text-red-600 mr-4">
                        <i class="fas fa-times-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Rejected</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $rejectedInternships }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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

                    <!-- Enhanced Filter Section -->
                    <div class="mb-6 bg-gradient-to-r from-gray-50 to-blue-50 p-5 rounded-lg shadow-sm border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-filter text-indigo-600 mr-2"></i> Filter Internships
                        </h3>
                        <form action="{{ route('magang.index') }}" method="GET" id="filter-form">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Period Filter -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-calendar-alt text-gray-400"></i>
                                        </div>
                                        <select id="periode_filter" name="periode_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @php
                                                $latestPeriode = App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
                                                $latestPeriodeId = $latestPeriode ? $latestPeriode->periode_id : '';
                                                $selectedPeriodeId = request('periode_id', $latestPeriodeId);
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
                                    <div class="bg-white rounded-md border border-gray-300 p-3 max-h-32 overflow-y-auto">
                                        @php
                                            $selectedJobs = request('jobs', []);
                                        @endphp

                                        <!-- Cook Position -->
                                        <div class="flex items-start mb-2">
                                            <div class="flex items-center h-5">
                                                <input id="job_JOB001" name="jobs[]" type="checkbox" value="JOB001"
                                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                    {{ in_array('JOB001', (array)$selectedJobs) ? 'checked' : '' }}>
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="job_JOB001" class="font-medium text-gray-700 flex items-center">
                                                    <i class="fas fa-utensils text-orange-500 mr-1"></i> Cook
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Pastry Chef Position -->
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="job_JOB004" name="jobs[]" type="checkbox" value="JOB004"
                                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                    {{ in_array('JOB004', (array)$selectedJobs) ? 'checked' : '' }}>
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="job_JOB004" class="font-medium text-gray-700 flex items-center">
                                                    <i class="fas fa-birthday-cake text-pink-500 mr-1"></i> Pastry Chef
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Filter -->
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <div class="bg-white rounded-md border border-gray-300 p-3 max-h-32 overflow-y-auto">
                                        @php
                                            $selectedStatuses = request('statuses', []);
                                        @endphp

                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <input id="status_pending" name="statuses[]" type="checkbox" value="Pending"
                                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                    {{ in_array('Pending', (array)$selectedStatuses) ? 'checked' : '' }}>
                                                <label for="status_pending" class="ml-2 text-sm font-medium text-gray-700 flex items-center">
                                                    <i class="fas fa-clock text-yellow-500 mr-1"></i> Pending
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="status_active" name="statuses[]" type="checkbox" value="Sedang Berjalan"
                                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                    {{ in_array('Sedang Berjalan', (array)$selectedStatuses) ? 'checked' : '' }}>
                                                <label for="status_active" class="ml-2 text-sm font-medium text-gray-700 flex items-center">
                                                    <i class="fas fa-play-circle text-green-500 mr-1"></i> Active
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="status_completed" name="statuses[]" type="checkbox" value="Lulus"
                                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                    {{ in_array('Lulus', (array)$selectedStatuses) ? 'checked' : '' }}>
                                                <label for="status_completed" class="ml-2 text-sm font-medium text-gray-700 flex items-center">
                                                    <i class="fas fa-check-circle text-purple-500 mr-1"></i> Completed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm hover:shadow transform hover:scale-105">
                                    <i class="fas fa-search mr-2"></i> Apply Filters
                                </button>

                                @if(request()->hasAny(['periode_id', 'sort_by', 'jobs', 'statuses']))
                                    <a href="{{ route('magang.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                                        <i class="fas fa-undo mr-2"></i> Reset Filters
                                    </a>
                                @endif
                            </div>
                        </form>
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
                                    <p class="text-sm text-gray-500">View SMART analysis and rankings for Cook position</p>
                                </div>
                            </a>

                            <a href="{{ route('magang.smartDashboard', ['job_id' => 'JOB004']) }}" class="flex items-center p-4 bg-white border border-pink-200 rounded-lg hover:bg-pink-50 transition duration-150 transform hover:-translate-y-1 hover:shadow-md">
                                <div class="bg-pink-100 p-3 rounded-full mr-4">
                                    <i class="fas fa-birthday-cake h-6 w-6 text-pink-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Pastry Chef Dashboard</h3>
                                    <p class="text-sm text-gray-500">View SMART analysis and rankings for Pastry Chef position</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    @if(count($magang) > 0)
                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-hashtag text-gray-400 mr-2"></i> No
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('magang.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'pelamar_nama', 'sort_dir' => request('sort_by') == 'pelamar_nama' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center hover:text-indigo-600">
                                                <i class="fas fa-user text-gray-400 mr-2"></i> Intern Name
                                                @if(request('sort_by') == 'pelamar_nama')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('magang.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'job_nama', 'sort_dir' => request('sort_by') == 'job_nama' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center hover:text-indigo-600">
                                                <i class="fas fa-briefcase text-gray-400 mr-2"></i> Position
                                                @if(request('sort_by') == 'job_nama')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('magang.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'periode_nama', 'sort_dir' => request('sort_by') == 'periode_nama' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center hover:text-indigo-600">
                                                <i class="fas fa-calendar text-gray-400 mr-2"></i> Period
                                                @if(request('sort_by') == 'periode_nama')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('magang.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'rank', 'sort_dir' => request('sort_by') == 'rank' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center hover:text-indigo-600">
                                                <i class="fas fa-trophy text-gray-400 mr-2"></i> Rank
                                                @if(request('sort_by') == 'rank')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('magang.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'total_skor', 'sort_dir' => request('sort_by') == 'total_skor' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center hover:text-indigo-600">
                                                <i class="fas fa-star text-gray-400 mr-2"></i> Total Score
                                                @if(request('sort_by') == 'total_skor')
                                                    @if(request('sort_dir') == 'asc')
                                                        <i class="fas fa-sort-up ml-1 text-indigo-600"></i>
                                                    @else
                                                        <i class="fas fa-sort-down ml-1 text-indigo-600"></i>
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-flag text-gray-400 mr-2"></i> Status
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-cog text-gray-400 mr-2"></i> Actions
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $i = ($magang->currentPage() - 1) * $magang->perPage() + 1;
                                    @endphp
                                    @foreach($magang as $m)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $i++ }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center text-white font-semibold">
                                                            {{ substr($m->pelamar->nama, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $m->pelamar->nama }}</div>
                                                        <div class="text-xs text-gray-500">{{ $m->pelamar->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $m->pelamar->job->job_id == 'JOB001' ? 'bg-orange-100 text-orange-800' : 'bg-pink-100 text-pink-800' }}">
                                                    <i class="fas {{ $m->pelamar->job->job_id == 'JOB001' ? 'fa-utensils' : 'fa-birthday-cake' }} mr-1"></i>
                                                    {{ $m->pelamar->job->nama_job }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $m->pelamar->periode->nama_periode }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full text-xs font-bold
                                                    {{ $m->rank == 1 ? 'bg-yellow-100 text-yellow-800' : ($m->rank == 2 ? 'bg-gray-100 text-gray-800' : ($m->rank == 3 ? 'bg-orange-100 text-orange-800' : 'bg-gray-50 text-gray-600')) }}">
                                                    {{ $m->rank ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">{{ number_format($m->total_skor, 2) }}</div>
                                                    <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                                                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full" style="width: {{ ($m->total_skor / 5) * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($m->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                                    @if($m->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                                    @if($m->status_seleksi === 'Lulus') bg-purple-100 text-purple-800 @endif
                                                    @if($m->status_seleksi === 'Sedang Berjalan') bg-green-100 text-green-800 @endif">
                                                    <i class="fas
                                                        @if($m->status_seleksi === 'Pending') fa-clock @endif
                                                        @if($m->status_seleksi === 'Tidak Lulus') fa-times-circle @endif
                                                        @if($m->status_seleksi === 'Lulus') fa-check-circle @endif
                                                        @if($m->status_seleksi === 'Sedang Berjalan') fa-play-circle @endif
                                                        mr-1"></i>
                                                    {{ $m->status_seleksi }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex space-x-2 justify-end">
                                                    <a href="{{ route('magang.show', $m) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 transform hover:scale-110" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('magang.edit', $m) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200 transform hover:scale-110" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('magang.destroy', $m) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this internship record?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200 transform hover:scale-110" title="Delete">
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
                            {{ $magang->appends(request()->except('page'))->links() }}
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        No internship records found. Try adjusting your filters or <a href="{{ route('magang.create') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">create a new internship record</a>.
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
            // Auto-submit form when period changes
            const periodeFilter = document.getElementById('periode_filter');
            periodeFilter.addEventListener('change', function() {
                // Show loading indicator
                const loadingDiv = document.createElement('div');
                loadingDiv.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                loadingDiv.innerHTML = `
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto mb-3"></div>
                        <p class="text-gray-700">Loading data...</p>
                    </div>
                `;
                document.body.appendChild(loadingDiv);

                // Submit the form
                document.getElementById('filter-form').submit();
            });

            // Add smooth animations to stats cards
            const statsCards = document.querySelectorAll('.grid > div');
            statsCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</x-app-layout>
