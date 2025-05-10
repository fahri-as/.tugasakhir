<x-crud-layout title="Schedule Interview">
    <form action="{{ route('interview.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="pelamar_id" class="block text-sm font-medium text-gray-700">Applicant</label>
            <select name="pelamar_id" id="pelamar_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Select Applicant</option>
                @foreach($pelamar as $p)
                    <option value="{{ $p->pelamar_id }}">{{ $p->nama }} - {{ $p->job->nama_job }} ({{ $p->periode->nama_periode }})</option>
                @endforeach
            </select>
            @error('pelamar_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">Interviewer</label>
            <select name="user_id" id="user_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @php
                    $hrUser = $users->firstWhere('role', 'hr');
                    $defaultUserId = $hrUser ? $hrUser->user_id : null;
                @endphp
                @foreach($users as $user)
                    <option value="{{ $user->user_id }}"
                        @selected(($user->role == 'hr' && !old('user_id')) || old('user_id') == $user->user_id || ($defaultUserId == $user->user_id))>
                        {{ $user->username }} @if($user->role == 'hr')(HR)@endif
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700">Schedule Date</label>
                <input type="date" name="jadwal_tanggal" id="jadwal_tanggal" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('jadwal_tanggal')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700">Schedule Time</label>
                <input type="time" name="jadwal_waktu" id="jadwal_waktu" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('jadwal_waktu')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div>
                <label for="kualifikasi_skor" class="block text-sm font-medium text-gray-700">Qualification Score (1-5)</label>
                <input type="number" name="kualifikasi_skor" id="kualifikasi_skor" min="1" max="5" value="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('kualifikasi_skor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="komunikasi_skor" class="block text-sm font-medium text-gray-700">Communication Score (1-5)</label>
                <input type="number" name="komunikasi_skor" id="komunikasi_skor" min="1" max="5" value="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('komunikasi_skor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sikap_skor" class="block text-sm font-medium text-gray-700">Attitude Score (1-5)</label>
                <input type="number" name="sikap_skor" id="sikap_skor" min="1" max="5" value="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('sikap_skor')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Hidden field for status_seleksi with default value -->
        <input type="hidden" name="status_seleksi" value="Pending">

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Schedule Interview
            </button>
            <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </form>
</x-crud-layout>
