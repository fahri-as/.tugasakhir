<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-list-check text-indigo-600 mr-2"></i> {{ __('Criteria Management') }}
            </h2>
            <a href="{{ route('criteria.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                <i class="fas fa-plus-circle mr-2"></i> Create New Criteria
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md mb-4 flex items-center shadow-sm" role="alert">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md mb-4 flex items-center shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(isset($job))
                <!-- Display criteria for specific job -->
                <div class="mb-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <i class="fas fa-briefcase text-indigo-600 mr-2"></i> Criteria for: <span class="font-bold ml-2">{{ $job->nama_job }}</span>
                                </h3>

                                <div class="flex space-x-2">
                                    <a href="{{ route('ahp.index', $job->job_id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                        <i class="fas fa-balance-scale mr-1"></i> AHP Weighting
                                    </a>
                                    <a href="{{ route('criteria.create', ['job_id' => $job->job_id]) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                        <i class="fas fa-plus mr-1"></i> Add Criteria
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    @php
                        $totalCriteria = $criteria->count();
                        $hasRatingScales = $criteria->filter(function($criterion) {
                            return $criterion->criteriaRatingScales && $criterion->criteriaRatingScales->count() > 0;
                        })->count();
                        $needsRatingScales = $totalCriteria - $hasRatingScales;
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <!-- Total Criteria -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-list-check text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Criteria</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $totalCriteria }}</p>
                            </div>
                        </div>

                        <!-- With Rating Scales -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">With Rating Scales</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $hasRatingScales }}</p>
                            </div>
                        </div>

                        <!-- Needs Rating Scales -->
                        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="rounded-full h-12 w-12 flex items-center justify-center bg-amber-100 text-amber-600 mr-4">
                                <i class="fas fa-exclamation-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Needs Rating Scales</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $needsRatingScales }}</p>
                            </div>
                        </div>
                    </div>

                    @if(count($criteria) > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-hashtag text-gray-400 mr-2"></i> Code
                                                </span>
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-tag text-gray-400 mr-2"></i> Name
                                                </span>
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-align-left text-gray-400 mr-2"></i> Description
                                                </span>
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-balance-scale text-gray-400 mr-2"></i> Weight
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
                                        @foreach($criteria as $criterion)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1.5 rounded-md">
                                                        {{ $criterion->code }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <div class="font-medium">{{ $criterion->name }}</div>
                                                    @if($criterion->criteriaRatingScales && $criterion->criteriaRatingScales->count() > 0)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ $criterion->criteriaRatingScales->count() }} rating scales
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Needs rating scales
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($criterion->description, 50) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <span class="px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">
                                                        {{ $criterion->weight }} ({{ number_format($criterion->weight * 100, 1) }}%)
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-3">
                                                        <a href="{{ route('criteria.show', $criterion->criteria_id) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('criteria.edit', $criterion->criteria_id) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('criteria.destroy', $criterion->criteria_id) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete" onclick="return confirm('Are you sure you want to delete this criteria?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('criteria.force-destroy', $criterion->criteria_id) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-800 hover:text-red-900 transition-colors duration-200" title="Force Delete" onclick="return confirm('WARNING: This will force delete the criteria and remove all associated data. This action cannot be undone. Are you sure?')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200 text-center">
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md inline-block text-left">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                No criteria found for this job.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('criteria.create', ['job_id' => $job->job_id]) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md mt-4">
                                    <i class="fas fa-plus mr-2"></i> Create First Criteria
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('criteria.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Job Categories
                        </a>
                    </div>
                </div>
            @else
                <!-- Display job categories as cards -->
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-indigo-600 mr-2"></i> Select a Job Position to Manage Criteria
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Cook Position Card -->
                    <a href="{{ route('criteria.index', ['job_id' => 'JOB001']) }}" class="bg-gradient-to-r from-gray-50 to-indigo-50 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow transform transition-transform hover:-translate-y-1 duration-300 border border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600 mr-4">
                                    <i class="fas fa-utensils text-xl"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Cook</h3>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">Manage criteria for Cook position.</p>

                            @if(isset($criteriaByJob['JOB001']))
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-list-check mr-1"></i> {{ count($criteriaByJob['JOB001']) }} criteria
                                    </div>
                                    <i class="fas fa-arrow-right text-indigo-500"></i>
                                </div>
                            @else
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-plus mr-1"></i> No criteria yet
                                    </div>
                                    <i class="fas fa-arrow-right text-indigo-500"></i>
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Pastry Chef Position Card -->
                    <a href="{{ route('criteria.index', ['job_id' => 'JOB004']) }}" class="bg-gradient-to-r from-gray-50 to-blue-50 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow transform transition-transform hover:-translate-y-1 duration-300 border border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <div class="rounded-full h-12 w-12 flex items-center justify-center bg-purple-100 text-purple-600 mr-4">
                                    <i class="fas fa-birthday-cake text-xl"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Pastry Chef</h3>
                            </div>
                            <p class="mt-2 text-sm text-gray-600">Manage criteria for Pastry Chef position.</p>

                            @if(isset($criteriaByJob['JOB004']))
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-list-check mr-1"></i> {{ count($criteriaByJob['JOB004']) }} criteria
                                    </div>
                                    <i class="fas fa-arrow-right text-indigo-500"></i>
                                </div>
                            @else
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-plus mr-1"></i> No criteria yet
                                    </div>
                                    <i class="fas fa-arrow-right text-indigo-500"></i>
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Dynamic Job Cards from Database -->
                    @foreach($criteriaByJob as $jobId => $jobCriteria)
                        @if($jobId != 'JOB001' && $jobId != 'JOB004')
                            <a href="{{ route('criteria.index', ['job_id' => $jobId]) }}" class="bg-gradient-to-r from-gray-50 to-green-50 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow transform transition-transform hover:-translate-y-1 duration-300 border border-gray-200">
                                <div class="p-6">
                                    <div class="flex items-center mb-3">
                                        <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                                            <i class="fas fa-briefcase text-xl"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900">{{ $jobCriteria->first()->job->nama_job }}</h3>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600">Manage criteria for {{ $jobCriteria->first()->job->nama_job }} position.</p>

                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-list-check mr-1"></i> {{ count($jobCriteria) }} criteria
                                        </div>
                                        <i class="fas fa-arrow-right text-indigo-500"></i>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
