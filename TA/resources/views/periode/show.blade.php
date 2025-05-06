<x-crud-layout title="Period Details">
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Period Information</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Period ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $periode->periode_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Period Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $periode->nama_periode }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Start Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $periode->tanggal_mulai->format('d M Y') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">End Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $periode->tanggal_selesai->format('d M Y') }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $periode->deskripsi }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Internship Duration</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $periode->durasi_minggu_magang }} weeks</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $periode->created_at->format('d M Y H:i:s') }}</dd>
                </div>
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-900">Available Jobs</h3>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach($periode->jobs as $job)
                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-lg">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">{{ $job->nama_job }}</h4>
                            <p class="text-sm text-gray-500">{{ $job->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('periode.edit', $periode) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Edit Period
            </a>
            <form action="{{ route('periode.destroy', $periode) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this period?')">
                    Delete Period
                </button>
            </form>
            <a href="{{ route('periode.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>
</x-crud-layout>
