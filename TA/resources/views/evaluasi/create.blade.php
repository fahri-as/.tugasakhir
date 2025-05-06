<x-crud-layout title="Create Weekly Evaluation">
    <form action="{{ route('evaluasi.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="evaluasi_id" class="block text-sm font-medium text-gray-700">Evaluation ID</label>
            <input type="text" name="evaluasi_id" id="evaluasi_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('evaluasi_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="magang_id" class="block text-sm font-medium text-gray-700">Internship</label>
            <select name="magang_id" id="magang_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Select Internship</option>
                @foreach($magang as $m)
                    <option value="{{ $m->magang_id }}" @selected(request()->get('magang_id') == $m->magang_id)>
                        {{ $m->pelamar->nama }} ({{ $m->pelamar->job->nama_job }})
                    </option>
                @endforeach
            </select>
            @error('magang_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="minggu_ke" class="block text-sm font-medium text-gray-700">Week Number</label>
            <input type="number" name="minggu_ke" id="minggu_ke" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('minggu_ke')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
            <div>
                <label for="kriteria1" class="block text-sm font-medium text-gray-700">Criteria 1 Score (1-5)</label>
                <input type="number" name="kriteria1" id="kriteria1" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('kriteria1')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kriteria2" class="block text-sm font-medium text-gray-700">Criteria 2 Score (1-5)</label>
                <input type="number" name="kriteria2" id="kriteria2" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('kriteria2')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kriteria3" class="block text-sm font-medium text-gray-700">Criteria 3 Score (1-5)</label>
                <input type="number" name="kriteria3" id="kriteria3" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('kriteria3')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kriteria4" class="block text-sm font-medium text-gray-700">Criteria 4 Score (1-5)</label>
                <input type="number" name="kriteria4" id="kriteria4" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('kriteria4')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kriteria5" class="block text-sm font-medium text-gray-700">Criteria 5 Score (1-5)</label>
                <input type="number" name="kriteria5" id="kriteria5" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('kriteria5')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Create Evaluation
            </button>
            <a href="{{ route('evaluasi.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
