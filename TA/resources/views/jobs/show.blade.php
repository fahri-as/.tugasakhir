<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-briefcase text-indigo-600 mr-2"></i> {{ __('Job Details') }}
            </h2>
            <div>
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-green-50" role="alert">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Job Information Card -->
                    <div class="mb-6 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-lg p-4 border border-indigo-100 shadow-sm">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                            <div class="flex items-center mb-3 md:mb-0">
                                <div class="h-16 w-16 rounded-full bg-indigo-100 border-2 border-indigo-200 flex items-center justify-center text-indigo-500 mr-4 shadow-sm">
                                    <i class="fas fa-briefcase text-3xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">{{ $job->nama_job }}</h3>
                                    <p class="text-gray-600 flex items-center">
                                        <i class="fas fa-id-card text-indigo-400 mr-2"></i>
                                        ID: {{ $job->job_id }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3 md:mt-0">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt text-indigo-400 mr-2"></i>
                                    Created: {{ $job->created_at->format('d M Y H:i:s') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-1">
                                    <i class="fas fa-clock text-indigo-400 mr-2"></i>
                                    Last Updated: {{ $job->updated_at->format('d M Y H:i:s') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                            <i class="fas fa-align-left text-indigo-600 mr-2"></i> Job Description
                        </h3>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <p class="text-gray-700">
                                {{ $job->deskripsi ?: 'No description provided.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Job Statistics -->
                    @php
                        // Count job-related statistics if available
                        $applicantCount = isset($job->pelamar) ? $job->pelamar->count() : 0;
                        $pendingCount = isset($job->pelamar) ? $job->pelamar->filter(function($p) { return $p->status === 'Pending'; })->count() : 0;
                        $passedCount = isset($job->pelamar) ? $job->pelamar->filter(function($p) { return $p->status === 'Lulus'; })->count() : 0;

                        // Load interview criteria
                        $interviewCriteria = \App\Models\InterviewCriteria::where('job_id', $job->job_id)->get();

                        // Load capability test criteria
                        $tesKemampuanCriteria = \App\Models\TesKemampuanCriteria::where('job_id', $job->job_id)->get();
                    @endphp

                    <div class="mb-6 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-4 border border-purple-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                            <i class="fas fa-chart-bar text-indigo-600 mr-2"></i> Job Statistics
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Total Applicants -->
                            <div class="bg-white rounded-lg p-3 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-sm font-medium text-gray-500">Total Applicants</h4>
                                    <span class="font-bold text-lg text-indigo-600">{{ $applicantCount }}</span>
                                </div>
                                <div class="mt-2 flex items-center">
                                    <i class="fas fa-users text-indigo-500 mr-2"></i>
                                    <span class="text-sm text-gray-600">Candidates for this position</span>
                                </div>
                            </div>

                            <!-- Pending Applications -->
                            <div class="bg-white rounded-lg p-3 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-sm font-medium text-gray-500">Pending</h4>
                                    <span class="font-bold text-lg text-yellow-600">{{ $pendingCount }}</span>
                                </div>
                                <div class="mt-2 flex items-center">
                                    <i class="fas fa-hourglass-half text-yellow-500 mr-2"></i>
                                    <span class="text-sm text-gray-600">Applications in process</span>
                                </div>
                            </div>

                            <!-- Passed Applications -->
                            <div class="bg-white rounded-lg p-3 shadow-sm transform transition duration-200 hover:-translate-y-1 hover:shadow">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-sm font-medium text-gray-500">Passed</h4>
                                    <span class="font-bold text-lg text-green-600">{{ $passedCount }}</span>
                                </div>
                                <div class="mt-2 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span class="text-sm text-gray-600">Successful candidates</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Interview Criteria & Rating Scales Section -->
                    <div class="mb-6 bg-gradient-to-r from-cyan-50 to-teal-50 rounded-lg p-4 border border-cyan-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                            <i class="fas fa-comments text-teal-600 mr-2"></i> Interview Criteria & Rating Scales
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            @forelse($interviewCriteria as $criteria)
                                <div class="bg-white rounded-lg p-4 shadow-sm border border-teal-100">
                                    <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-teal-900">{{ $criteria->name }}</h4>
                                        <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-1 rounded">{{ $criteria->code }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">{{ $criteria->description }}</p>
                                    <div class="flex justify-between items-center text-xs text-gray-500">
                                        <span>Weight: {{ number_format($criteria->weight * 100, 0) }}%</span>
                                        <a href="#"
                                            onclick="toggleRatingScales('interview-scales-{{ $criteria->criteria_id }}')"
                                            class="text-teal-600 hover:text-teal-800">
                                            <i class="fas fa-star-half-alt mr-1"></i> View Rating Scales
                                        </a>
                                    </div>

                                    <!-- Rating Scales Container (Hidden by Default) -->
                                    <div id="interview-scales-{{ $criteria->criteria_id }}" class="hidden mt-3 pt-3 border-t border-teal-100">
                                        <div class="flex justify-between items-center mb-2">
                                            <h5 class="text-sm font-medium text-gray-700">Rating Scales</h5>
                                            <a href="{{ route('interview-rating-scales.create', ['criteria_id' => $criteria->criteria_id]) }}"
                                                class="text-xs bg-teal-600 hover:bg-teal-700 text-white px-2 py-1 rounded">
                                                <i class="fas fa-plus"></i> Add Scale
                                            </a>
                                        </div>

                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200 text-xs">
                                                <thead>
                                                    <tr>
                                                        <th class="px-2 py-2 bg-teal-50 text-left text-xs font-medium text-teal-800">Level</th>
                                                        <th class="px-2 py-2 bg-teal-50 text-left text-xs font-medium text-teal-800">Name</th>
                                                        <th class="px-2 py-2 bg-teal-50 text-left text-xs font-medium text-teal-800">Description</th>
                                                        <th class="px-2 py-2 bg-teal-50 text-right text-xs font-medium text-teal-800">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @forelse($criteria->ratingScales as $scale)
                                                        <tr>
                                                            <td class="px-2 py-2 whitespace-nowrap">
                                                                <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2 py-0.5 rounded">
                                                                    Level {{ $scale->rating_level }}
                                                                </span>
                                                            </td>
                                                            <td class="px-2 py-2 whitespace-nowrap">{{ $scale->name }}</td>
                                                            <td class="px-2 py-2">{{ $scale->description }}</td>
                                                            <td class="px-2 py-2 whitespace-nowrap text-right">
                                                                <div class="flex space-x-2 justify-end">
                                                                    <a href="{{ route('interview-rating-scales.edit', $scale->id) }}" class="text-teal-600 hover:text-teal-900" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <form method="POST" action="{{ route('interview-rating-scales.destroy', $scale->id) }}" class="inline-block">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Delete" onclick="return confirm('Are you sure you want to delete this rating scale?')">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="px-2 py-3 text-center text-gray-500">
                                                                No rating scales defined. <a href="{{ route('interview-rating-scales.create', ['criteria_id' => $criteria->criteria_id]) }}" class="text-teal-600 hover:underline">Add one</a>.
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-3 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                No interview criteria defined for this job.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Capability Test Criteria & Rating Scales Section -->
                    <div class="mb-6 bg-gradient-to-r from-amber-50 to-orange-50 rounded-lg p-4 border border-amber-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                            <i class="fas fa-tasks text-amber-600 mr-2"></i> Capability Test Criteria & Rating Scales
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            @forelse($tesKemampuanCriteria as $criteria)
                                <div class="bg-white rounded-lg p-4 shadow-sm border border-amber-100">
                                    <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-amber-900">{{ $criteria->name }}</h4>
                                        <span class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-1 rounded">{{ $criteria->code }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3">{{ $criteria->description }}</p>
                                    <div class="flex justify-between items-center text-xs text-gray-500">
                                        <span>Weight: {{ number_format($criteria->weight * 100, 0) }}%</span>
                                        <a href="#"
                                            onclick="toggleRatingScales('test-scales-{{ $criteria->criteria_id }}')"
                                            class="text-amber-600 hover:text-amber-800">
                                            <i class="fas fa-star-half-alt mr-1"></i> View Rating Scales
                                        </a>
                                    </div>

                                    <!-- Rating Scales Container (Hidden by Default) -->
                                    <div id="test-scales-{{ $criteria->criteria_id }}" class="hidden mt-3 pt-3 border-t border-amber-100">
                                        <div class="flex justify-between items-center mb-2">
                                            <h5 class="text-sm font-medium text-gray-700">Rating Scales</h5>
                                            <a href="{{ route('tes-kemampuan-rating-scales.create', ['criteria_id' => $criteria->criteria_id]) }}"
                                                class="text-xs bg-amber-600 hover:bg-amber-700 text-white px-2 py-1 rounded">
                                                <i class="fas fa-plus"></i> Add Scale
                                            </a>
                                        </div>

                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200 text-xs">
                                                <thead>
                                                    <tr>
                                                        <th class="px-2 py-2 bg-amber-50 text-left text-xs font-medium text-amber-800">Level</th>
                                                        <th class="px-2 py-2 bg-amber-50 text-left text-xs font-medium text-amber-800">Name</th>
                                                        <th class="px-2 py-2 bg-amber-50 text-left text-xs font-medium text-amber-800">Score Range</th>
                                                        <th class="px-2 py-2 bg-amber-50 text-left text-xs font-medium text-amber-800">Description</th>
                                                        <th class="px-2 py-2 bg-amber-50 text-right text-xs font-medium text-amber-800">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @forelse($criteria->ratingScales as $scale)
                                                        <tr>
                                                            <td class="px-2 py-2 whitespace-nowrap">
                                                                <span class="bg-amber-100 text-amber-800 text-xs font-medium px-2 py-0.5 rounded">
                                                                    Level {{ $scale->rating_level }}
                                                                </span>
                                                            </td>
                                                            <td class="px-2 py-2 whitespace-nowrap">{{ $scale->name }}</td>
                                                            <td class="px-2 py-2 whitespace-nowrap">{{ $scale->min_score }} - {{ $scale->max_score }}</td>
                                                            <td class="px-2 py-2">{{ $scale->description }}</td>
                                                            <td class="px-2 py-2 whitespace-nowrap text-right">
                                                                <div class="flex space-x-2 justify-end">
                                                                    <a href="{{ route('tes-kemampuan-rating-scales.edit', $scale->id) }}" class="text-amber-600 hover:text-amber-900" title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <form method="POST" action="{{ route('tes-kemampuan-rating-scales.destroy', $scale->id) }}" class="inline-block">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Delete" onclick="return confirm('Are you sure you want to delete this rating scale?')">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="px-2 py-3 text-center text-gray-500">
                                                                No rating scales defined. <a href="{{ route('tes-kemampuan-rating-scales.create', ['criteria_id' => $criteria->criteria_id]) }}" class="text-amber-600 hover:underline">Add one</a>.
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-3 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                No capability test criteria defined for this job.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <a href="{{ route('jobs.edit', $job) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                            <i class="fas fa-edit mr-2"></i> Edit Job
                        </a>
                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md" onclick="return confirm('Are you sure you want to delete this job?')">
                                <i class="fas fa-trash mr-2"></i> Delete Job
                            </button>
                        </form>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                            <i class="fas fa-arrow-left mr-2"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleRatingScales(id) {
            const element = document.getElementById(id);
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    </script>
    @endpush
</x-app-layout>
