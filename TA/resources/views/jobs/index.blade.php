<x-crud-layout title="Jobs Management" createRoute="{{ route('jobs.create') }}" createIcon="fa-briefcase" createText="Create New Job">
    <!-- Stats Overview -->
    @php
        $totalJobs = $jobs->count();

        // Count applicants per job if relationship exists
        $jobsWithApplicants = $jobs->filter(function($job) {
            return isset($job->pelamar) && $job->pelamar->count() > 0;
        })->count();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Jobs -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-briefcase text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Jobs</p>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalJobs }}</p>
            </div>
        </div>

        <!-- Jobs with Applicants -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-600 mr-4">
                <i class="fas fa-user-check text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Jobs With Applicants</p>
                <p class="text-2xl font-semibold text-gray-800">{{ $jobsWithApplicants }}</p>
            </div>
        </div>

        <!-- Latest Job -->
        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 rounded-lg shadow-sm p-4 flex items-center transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="rounded-full h-12 w-12 flex items-center justify-center bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Latest Job</p>
                <p class="text-xl font-semibold text-gray-800">{{ $jobs->sortByDesc('created_at')->first()->nama_job ?? 'None' }}</p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <span class="flex items-center">
                            <i class="fas fa-hashtag text-gray-400 mr-2"></i> No
                        </span>
                    </th>
                    <th class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <span class="flex items-center">
                            <i class="fas fa-briefcase text-gray-400 mr-2"></i> Job Name
                        </span>
                    </th>
                    <th class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <span class="flex items-center">
                            <i class="fas fa-align-left text-gray-400 mr-2"></i> Description
                        </span>
                    </th>
                    <th class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <span class="flex items-center">
                            <i class="fas fa-cog text-gray-400 mr-2"></i> Actions
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($jobs as $job)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $job->nama_job }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 line-clamp-2">{{ $job->deskripsi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex space-x-3 justify-end">
                                <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('jobs.edit', $job) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this job?')">
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
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            No jobs found. <a href="{{ route('jobs.create') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">Create a new job</a>.
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

    @if(method_exists($jobs, 'links'))
        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    @endif
</x-crud-layout>
