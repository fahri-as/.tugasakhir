<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-tachometer-alt mr-2 text-indigo-600"></i> {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                @php
                    $activeApplicants = \App\Models\Pelamar::where('status_seleksi', '!=', 'Rejected')->count();
                    $activeInterns = \App\Models\Magang::where('status_seleksi', 'Active')->count();
                    $upcomingInterviews = \App\Models\Interview::where('jadwal', '>=', now())->count();
                    $totalPositions = \App\Models\Job::count();
                @endphp

                <!-- Active Applications -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm p-6 flex items-center transform hover:-translate-y-1 transition-all duration-300">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="pl-4">
                        <p class="text-sm text-gray-600">Active Applications</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $activeApplicants }}</p>
                    </div>
                </div>

                <!-- Active Interns -->
                <div class="bg-gradient-to-r from-green-50 to-teal-50 border border-green-100 rounded-lg shadow-sm p-6 flex items-center transform hover:-translate-y-1 transition-all duration-300">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600">
                        <i class="fas fa-user-graduate text-xl"></i>
                    </div>
                    <div class="pl-4">
                        <p class="text-sm text-gray-600">Active Interns</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $activeInterns }}</p>
                    </div>
                </div>

                <!-- Upcoming Interviews -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 rounded-lg shadow-sm p-6 flex items-center transform hover:-translate-y-1 transition-all duration-300">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-purple-100 text-purple-600">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                    <div class="pl-4">
                        <p class="text-sm text-gray-600">Upcoming Interviews</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $upcomingInterviews }}</p>
                    </div>
                </div>

                <!-- Total Positions -->
                <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-100 rounded-lg shadow-sm p-6 flex items-center transform hover:-translate-y-1 transition-all duration-300">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-amber-100 text-amber-600">
                        <i class="fas fa-briefcase text-xl"></i>
                    </div>
                    <div class="pl-4">
                        <p class="text-sm text-gray-600">Total Positions</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalPositions }}</p>
                    </div>
                </div>
            </div>

            <!-- Main Modules Section -->
            <h3 class="text-lg font-semibold text-gray-800 mb-4 px-1 flex items-center">
                <i class="fas fa-th-large text-indigo-600 mr-2"></i> Management Modules
            </h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-8">
                <a href="{{ route('job.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3 group-hover:bg-blue-200 transition-colors">
                                <i class="fas fa-briefcase text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Jobs</h3>
                        </div>
                        <p class="text-sm text-gray-600">Manage available internship positions and their requirements.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('periode.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3 group-hover:bg-indigo-200 transition-colors">
                                <i class="fas fa-calendar-alt text-indigo-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Periods</h3>
                        </div>
                        <p class="text-sm text-gray-600">Manage internship periods and their associated jobs.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('pelamar.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3 group-hover:bg-green-200 transition-colors">
                                <i class="fas fa-user-friends text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Applicants</h3>
                        </div>
                        <p class="text-sm text-gray-600">View and manage internship applications.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>


                <a href="{{ route('interview.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3 group-hover:bg-purple-200 transition-colors">
                                <i class="fas fa-comments text-purple-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Interviews</h3>
                        </div>
                        <p class="text-sm text-gray-600">Schedule and manage applicant interviews.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('tes-kemampuan.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center mr-3 group-hover:bg-orange-200 transition-colors">
                                <i class="fas fa-tasks text-orange-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Skill Tests</h3>
                        </div>
                        <p class="text-sm text-gray-600">Manage applicant skill assessments.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('magang.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center mr-3 group-hover:bg-teal-200 transition-colors">
                                <i class="fas fa-user-graduate text-teal-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Internships</h3>
                        </div>
                        <p class="text-sm text-gray-600">Track active internships and their progress.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('evaluasi.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center mr-3 group-hover:bg-pink-200 transition-colors">
                                <i class="fas fa-chart-line text-pink-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Evaluations</h3>
                        </div>
                        <p class="text-sm text-gray-600">Manage weekly intern performance evaluations.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('criteria.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 border border-gray-100 group">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center mr-3 group-hover:bg-amber-200 transition-colors">
                                <i class="fas fa-clipboard-list text-amber-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Criteria</h3>
                        </div>
                        <p class="text-sm text-gray-600">Define and manage selection criteria for job positions.</p>
                        <div class="mt-4 text-xs text-indigo-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span>View details</span>
                            <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>

                <!-- Decision Support System Section (commented out as per original) -->
                {{-- <div class="sm:col-span-2 lg:col-span-3 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 ">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Decision Support System</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                            Use our decision support system to help select the best candidates for Cook and Pastry Chef positions
                            using AHP (Analytic Hierarchy Process) for weighting criteria and SMART (Simple Multi-Attribute Rating Technique) for ranking.
                        </p>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                                <h4 class="font-medium text-gray-800 dark:text-gray-200">Cook Position (JOB001)</h4>
                                <div class="mt-4 space-y-2">
                                    <a href="{{ route('criteria.index', ['job_id' => 'JOB001']) }}" class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                        Manage Criteria
                                    </a>
                                    <a href="{{ route('ahp.index', 'JOB001') }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        AHP Criteria Weighting
                                    </a>
                                    <a href="{{ route('smart.index', 'JOB001') }}" class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                        SMART Ranking
                                    </a>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                                <h4 class="font-medium text-gray-800 dark:text-gray-200">Pastry Chef Position (JOB004)</h4>
                                <div class="mt-4 space-y-2">
                                    <a href="{{ route('criteria.index', ['job_id' => 'JOB004']) }}" class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                        Manage Criteria
                                    </a>
                                    <a href="{{ route('ahp.index', 'JOB004') }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        AHP Criteria Weighting
                                    </a>
                                    <a href="{{ route('smart.index', 'JOB004') }}" class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                        SMART Ranking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Upcoming Schedules Section -->
            <div class="mt-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 px-1 flex items-center">
                    <i class="fas fa-calendar text-indigo-600 mr-2"></i> Upcoming Schedules
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Interview Schedules -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-comments text-indigo-600"></i>
                                    </div>
                                <h3 class="text-lg font-medium text-gray-900">Upcoming Interviews</h3>
                                </div>
                                <a href="{{ route('interview.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>

                            @php
                                // Get upcoming interviews (next 7 days)
                                $upcomingInterviews = App\Models\Interview::where('jadwal', '>=', now())
                                    ->where('jadwal', '<=', now()->addDays(7))
                                    ->orderBy('jadwal')
                                    ->with('pelamar')
                                    ->limit(5)
                                    ->get();
                            @endphp

                            @if($upcomingInterviews->count() > 0)
                                <ul class="divide-y divide-gray-100">
                                    @foreach($upcomingInterviews as $interview)
                                        <li class="py-3 hover:bg-gray-50 rounded-md px-2 transition-colors">
                                            <div class="flex justify-between">
                                                <div>
                                                    <a href="{{ route('interview.show', $interview) }}" class="font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
                                                        <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                                                        {{ $interview->pelamar->nama }}
                                                    </a>
                                                    <p class="text-sm text-gray-600 ml-6">
                                                        <i class="fas fa-briefcase mr-1 text-gray-400"></i>
                                                        {{ $interview->pelamar->job->nama_job }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm font-medium text-gray-800">
                                                        <i class="far fa-calendar mr-1 text-gray-400"></i>
                                                        {{ $interview->jadwal->format('d M Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        <i class="far fa-clock mr-1 text-gray-400"></i>
                                                        {{ $interview->jadwal->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-8 bg-gray-50 rounded-lg">
                                    <i class="fas fa-calendar-times text-gray-400 text-3xl mb-2"></i>
                                    <p class="text-gray-500">No upcoming interviews scheduled</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Skill Test Schedules -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-tasks text-orange-600"></i>
                                    </div>
                                <h3 class="text-lg font-medium text-gray-900">Upcoming Skill Tests</h3>
                                </div>
                                <a href="{{ route('tes-kemampuan.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center">
                                    View All <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>

                            @php
                                // Get upcoming skill tests (next 7 days)
                                $upcomingTests = App\Models\TesKemampuan::where('jadwal', '>=', now())
                                    ->where('jadwal', '<=', now()->addDays(7))
                                    ->orderBy('jadwal')
                                    ->with('pelamar')
                                    ->limit(5)
                                    ->get();
                            @endphp

                            @if($upcomingTests->count() > 0)
                                <ul class="divide-y divide-gray-100">
                                    @foreach($upcomingTests as $test)
                                        <li class="py-3 hover:bg-gray-50 rounded-md px-2 transition-colors">
                                            <div class="flex justify-between">
                                                <div>
                                                    <a href="{{ route('tes-kemampuan.show', $test) }}" class="font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
                                                        <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                                                        {{ $test->pelamar->nama }}
                                                    </a>
                                                    <p class="text-sm text-gray-600 ml-6">
                                                        <i class="fas fa-briefcase mr-1 text-gray-400"></i>
                                                        {{ $test->pelamar->job->nama_job }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm font-medium text-gray-800">
                                                        <i class="far fa-calendar mr-1 text-gray-400"></i>
                                                        {{ $test->jadwal->format('d M Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        <i class="far fa-clock mr-1 text-gray-400"></i>
                                                        {{ $test->jadwal->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-8 bg-gray-50 rounded-lg">
                                    <i class="fas fa-clipboard-list text-gray-400 text-3xl mb-2"></i>
                                    <p class="text-gray-500">No upcoming skill tests scheduled</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include FontAwesome -->
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    </style>
</x-app-layout>
