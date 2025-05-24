<x-crud-layout title="Schedule New Skill Test" icon="fa-vial">
    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-lg border border-purple-100 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
            <i class="fas fa-vial text-purple-600 mr-2"></i> Skill Test Details
        </h3>

        <form action="{{ route('tes-kemampuan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="transform transition duration-200 hover:-translate-y-1">
                    <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">Applicant</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <select name="pelamar_id" id="pelamar_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            <option value="">Select Applicant</option>
                            @foreach($pelamar as $p)
                                <option value="{{ $p->pelamar_id }}">{{ $p->nama }} - {{ $p->job->nama_job }} ({{ $p->periode->nama_periode }})</option>
                            @endforeach
                        </select>
                    </div>
                    @error('pelamar_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="transform transition duration-200 hover:-translate-y-1">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Test Supervisor</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tie text-gray-400"></i>
                        </div>
                        <select name="user_id" id="user_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            <option value="">Select Supervisor</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_id }}" @selected(old('user_id') == $user->user_id)>
                                    {{ $user->username }} @if($user->role == 'hr')(HR)@endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-clock text-purple-500 mr-2"></i> Test Schedule
                </h4>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700 mb-1">Test Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <input type="date" name="jadwal_tanggal" id="jadwal_tanggal" value="{{ old('jadwal_tanggal') }}" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        </div>
                        @error('jadwal_tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700 mb-1">Test Time</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                            <input type="time" name="jadwal_waktu" id="jadwal_waktu" value="{{ old('jadwal_waktu') }}" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        </div>
                        @error('jadwal_waktu')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg border border-blue-100 shadow-sm">
                <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-chart-line text-purple-500 mr-2"></i> Test Evaluation
                </h4>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="skor" class="block text-sm font-medium text-gray-700 mb-1">Score (0-100)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-star text-gray-400"></i>
                            </div>
                            <input type="number" name="skor" id="skor" min="0" max="100" value="{{ old('skor', 0) }}" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 text-sm">/100</span>
                            </div>
                        </div>
                        @error('skor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="status_seleksi" class="block text-sm font-medium text-gray-700 mb-1">Test Status</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-flag text-gray-400"></i>
                            </div>
                            <select name="status_seleksi" id="status_seleksi" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                <option value="Pending" selected>Pending</option>
                                <option value="Tidak Lulus">Tidak Lulus</option>
                                <option value="Lulus">Lulus</option>
                                <option value="Magang">Magang</option>
                            </select>
                        </div>
                        @error('status_seleksi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2 transform transition duration-200 hover:-translate-y-1">
                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Test Notes</label>
                        <div class="relative">
                            <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                <i class="fas fa-sticky-note text-gray-400"></i>
                            </div>
                            <textarea name="catatan" id="catatan" rows="3" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('catatan') }}</textarea>
                        </div>
                        @error('catatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-600 hover:to-indigo-700 active:bg-purple-800 focus:outline-none focus:border-purple-700 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-save mr-2"></i> Schedule Test
                </button>
                <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set minimum date to today
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('jadwal_tanggal').setAttribute('min', formattedDate);
            document.getElementById('jadwal_tanggal').value = formattedDate;
            // Set default time to current time + 1 hour
            const hour = today.getHours() + 1;
            const formattedHour = hour.toString().padStart(2, '0');
            const formattedMinutes = today.getMinutes().toString().padStart(2, '0');
            document.getElementById('jadwal_waktu').value = `${formattedHour}:${formattedMinutes}`;
        });
    </script>
</x-crud-layout>
