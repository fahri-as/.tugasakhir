<x-crud-layout title="Edit Skill Test">
    <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="tes_id" class="block text-sm font-medium text-gray-700">Test ID</label>
            <input type="text" id="tes_id" value="{{ $tesKemampuan->tes_id }}" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm">
        </div>

        <div>
            <label for="pelamar_id" class="block text-sm font-medium text-gray-700">Applicant</label>
            <select name="pelamar_id" id="pelamar_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($pelamar as $p)
                    <option value="{{ $p->pelamar_id }}" @selected($p->pelamar_id == $tesKemampuan->pelamar_id)>
                        {{ $p->nama }} ({{ $p->job->nama_job }})
                    </option>
                @endforeach
            </select>
            @error('pelamar_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">Assigned To</label>
            <select name="user_id" id="user_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($users as $user)
                    <option value="{{ $user->user_id }}" @selected($user->user_id == $tesKemampuan->user_id)>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="jadwal" class="block text-sm font-medium text-gray-700">Schedule Date and Time</label>
            <input type="datetime-local" name="jadwal" id="jadwal" value="{{ old('jadwal', $tesKemampuan->jadwal->format('Y-m-d\TH:i')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('jadwal')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="skor" class="block text-sm font-medium text-gray-700">Score (0-100)</label>
            <input type="number" name="skor" id="skor" value="{{ old('skor', $tesKemampuan->skor) }}" min="0" max="100" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('skor')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="status_seleksi" class="block text-sm font-medium text-gray-700">Selection Status</label>
            <select name="status_seleksi" id="status_seleksi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="Pending" @selected($tesKemampuan->status_seleksi == 'Pending')>Pending</option>
                <option value="Tidak Lulus" @selected($tesKemampuan->status_seleksi == 'Tidak Lulus')>Tidak Lulus</option>
                <option value="Lulus" @selected($tesKemampuan->status_seleksi == 'Lulus')>Lulus</option>
                <option value="Magang" @selected($tesKemampuan->status_seleksi == 'Magang')>Magang</option>
            </select>
            @error('status_seleksi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="catatan" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="catatan" id="catatan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan', $tesKemampuan->catatan) }}</textarea>
            @error('catatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Update Test
            </button>
            <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
