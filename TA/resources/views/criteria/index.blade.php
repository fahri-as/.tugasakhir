<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Criteria Management') }}
            </h2>
            <a href="{{ route('criteria.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Add New Criteria
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if(isset($job))
                <!-- Display criteria for specific job -->
                <div class="mb-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-medium text-gray-900">Criteria for: {{ $job->nama_job }}</h3>

                                <a href="{{ route('criteria.create', ['job_id' => $job->job_id]) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Add Criteria
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(count($criteria) > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($criteria as $criterion)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $criterion->criteria_id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $criterion->code }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $criterion->name }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($criterion->description, 50) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $criterion->weight }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('criteria.show', $criterion->criteria_id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                                        <a href="{{ route('criteria.edit', $criterion->criteria_id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                        <form action="{{ route('criteria.destroy', $criterion->criteria_id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this criteria?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200 text-center">
                                <p class="text-gray-500">No criteria found for this job.</p>
                                <a href="{{ route('criteria.create', ['job_id' => $job->job_id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">
                                    Create First Criteria
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('criteria.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Job Categories</a>
                    </div>
                </div>
            @else
                <!-- Display job categories as cards -->
                <h3 class="text-lg font-medium text-gray-900 mb-4">Select a Job Position to Manage Criteria</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Cook Position Card -->
                    <a href="{{ route('criteria.index', ['job_id' => 'JOB001']) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Cook</h3>
                            <p class="mt-2 text-sm text-gray-600">Manage criteria for Cook position.</p>

                            @if(isset($criteriaByJob['JOB001']))
                                <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ count($criteriaByJob['JOB001']) }} criteria
                                </div>
                            @else
                                <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    No criteria yet
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Pastry Chef Position Card -->
                    <a href="{{ route('criteria.index', ['job_id' => 'JOB004']) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Pastry Chef</h3>
                            <p class="mt-2 text-sm text-gray-600">Manage criteria for Pastry Chef position.</p>

                            @if(isset($criteriaByJob['JOB004']))
                                <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ count($criteriaByJob['JOB004']) }} criteria
                                </div>
                            @else
                                <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    No criteria yet
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Dynamic Job Cards from Database -->
                    @foreach($criteriaByJob as $jobId => $jobCriteria)
                        @if($jobId != 'JOB001' && $jobId != 'JOB004')
                            <a href="{{ route('criteria.index', ['job_id' => $jobId]) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                                <div class="p-6 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $jobCriteria->first()->job->nama_job }}</h3>
                                    <p class="mt-2 text-sm text-gray-600">Manage criteria for {{ $jobCriteria->first()->job->nama_job }} position.</p>

                                    <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ count($jobCriteria) }} criteria
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
