<x-crud-layout title="Job Details">
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Job Details</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Job ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->job_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Job Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->nama_job }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->deskripsi }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->created_at->format('d M Y H:i:s') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $job->updated_at->format('d M Y H:i:s') }}</dd>
                </div>
            </dl>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('jobs.edit', $job) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Edit Job
            </a>
            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this job?')">
                    Delete Job
                </button>
            </form>
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>
</x-crud-layout>
