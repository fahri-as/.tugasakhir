<x-crud-layout title="Edit Interview">
    <form action="{{ route('interview.update', $interview) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="interview_id" class="block text-sm font-medium text-gray-700">Interview ID</label>
            <input type="text" id="interview_id" value="{{ $interview->interview_id }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm">
        </div>

        <div>
            <label for="pelamar_id" class="block text-sm font-medium text-gray-700">Applicant</label>
            <select name="pelamar_id" id="pelamar_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($pelamar as $p)
                    <option value="{{ $p->pelamar_id }}" @selected($p->pelamar_id == $interview->pelamar_id)>
                        {{ $p->nama }} ({{ $p->job->nama_job }})
                    </option>
                @endforeach
            </select>
            @error('pelamar_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="jadwal" class="block text-sm font-medium text-gray-700">Schedule Date</label>
            <input type="date" name="jadwal" id="jadwal" value="{{ old('jadwal', $interview->jadwal->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('jadwal')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div>
                <label for="kualifikasi_skor" class="block text-sm font-medium text-gray-700">Qualification Score (1-5)</label>
                <input type="number" name="kualifikasi_skor" id="kualifikasi_skor" value="{{ old('kualifikasi_skor', $interview->kualifikasi_skor) }}" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('kualifikasi_skor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="komunikasi_skor" class="block text-sm font-medium text-gray-700">Communication Score (1-5)</label>
                <input type="number" name="komunikasi_skor" id="komunikasi_skor" value="{{ old('komunikasi_skor', $interview->komunikasi_skor) }}" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('komunikasi_skor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sikap_skor" class="block text-sm font-medium text-gray-700">Attitude Score (1-5)</label>
                <input type="number" name="sikap_skor" id="sikap_skor" value="{{ old('sikap_skor', $interview->sikap_skor) }}" min="1" max="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('sikap_skor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Update Interview
            </button>
            <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
