<x-crud-layout title="Edit Job">
    <form action="{{ route('jobs.update', $job) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="job_id" class="block text-sm font-medium text-gray-700">Job ID</label>
            <input type="text" id="job_id" value="{{ $job->job_id }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm">
        </div>

        <div>
            <label for="nama_job" class="block text-sm font-medium text-gray-700">Job Name</label>
            <input type="text" name="nama_job" id="nama_job" value="{{ old('nama_job', $job->nama_job) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('nama_job')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $job->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Update Job
            </button>
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
