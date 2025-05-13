<x-crud-layout title="Create Period">
    <form action="{{ route('periode.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="nama_periode" class="block text-sm font-medium text-gray-700">Period Name</label>
            <input type="text" name="nama_periode" id="nama_periode" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('nama_periode')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('tanggal_mulai')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('tanggal_selesai')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="durasi_minggu_magang" class="block text-sm font-medium text-gray-700">Internship Duration (Weeks)</label>
            <input type="number" name="durasi_minggu_magang" id="durasi_minggu_magang" required min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('durasi_minggu_magang')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Available Jobs</label>
            <div class="mt-2 space-y-2">
                @foreach($jobs as $job)
                    <div class="flex items-center">
                        <input type="checkbox" name="jobs[]" id="job_{{ $job->job_id }}" value="{{ $job->job_id }}"
                               class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="job_{{ $job->job_id }}" class="ml-2 text-sm text-gray-900">
                            {{ $job->nama_job }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('jobs')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Create Period
            </button>
            <a href="{{ route('periode.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
