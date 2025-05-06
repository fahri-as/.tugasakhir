<x-crud-layout title="Schedule Skill Test">
    <form action="{{ route('tes-kemampuan.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="tes_id" class="block text-sm font-medium text-gray-700">Test ID</label>
            <input type="text" name="tes_id" id="tes_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('tes_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="pelamar_id" class="block text-sm font-medium text-gray-700">Applicant</label>
            <select name="pelamar_id" id="pelamar_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Select Applicant</option>
                @foreach($pelamar as $p)
                    <option value="{{ $p->pelamar_id }}">{{ $p->nama }} ({{ $p->job->nama_job }})</option>
                @endforeach
            </select>
            @error('pelamar_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="jadwal" class="block text-sm font-medium text-gray-700">Schedule Date</label>
            <input type="date" name="jadwal" id="jadwal" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('jadwal')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="skor" class="block text-sm font-medium text-gray-700">Score (0-100)</label>
            <input type="number" name="skor" id="skor" min="0" max="100" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('skor')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="catatan" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="catatan" id="catatan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            @error('catatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Schedule Test
            </button>
            <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
