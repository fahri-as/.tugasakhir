<x-crud-layout title="Edit Internship Record">
    <form action="{{ route('magang.update', $magang) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="magang_id" class="block text-sm font-medium text-gray-700">Internship ID</label>
            <input type="text" id="magang_id" value="{{ $magang->magang_id }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm">
        </div>

        <div>
            <label for="pelamar_id" class="block text-sm font-medium text-gray-700">Applicant</label>
            <select name="pelamar_id" id="pelamar_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($pelamar as $p)
                    <option value="{{ $p->pelamar_id }}" @selected($p->pelamar_id == $magang->pelamar_id)>
                        {{ $p->nama }} ({{ $p->job->nama_job }})
                    </option>
                @endforeach
            </select>
            @error('pelamar_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="total_skor" class="block text-sm font-medium text-gray-700">Total Score (0-5)</label>
            <input type="number" name="total_skor" id="total_skor" value="{{ old('total_skor', $magang->total_skor) }}"
                   step="0.01" min="0" max="5" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('total_skor')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status_seleksi" class="block text-sm font-medium text-gray-700">Selection Status</label>
            <select name="status_seleksi" id="status_seleksi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="pending" @selected($magang->status_seleksi == 'pending')>Pending</option>
                <option value="accepted" @selected($magang->status_seleksi == 'accepted')>Accepted</option>
                <option value="rejected" @selected($magang->status_seleksi == 'rejected')>Rejected</option>
            </select>
            @error('status_seleksi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Update Record
            </button>
            <a href="{{ route('magang.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
