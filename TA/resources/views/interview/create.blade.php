<x-crud-layout title="Schedule New Interview" icon="fa-calendar-plus">
    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 p-6 rounded-lg border border-indigo-100 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
            <i class="fas fa-calendar-plus text-indigo-600 mr-2"></i> Interview Details
        </h3>

        <form action="{{ route('interview.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="transform transition duration-200 hover:-translate-y-1">
                    <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">Applicant</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <select name="pelamar_id" id="pelamar_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Interviewer</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tie text-gray-400"></i>
                        </div>
                        <select name="user_id" id="user_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                    </div>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-clock text-indigo-500 mr-2"></i> Schedule
                </h4>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700 mb-1">Interview Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <input type="date" name="jadwal_tanggal" id="jadwal_tanggal" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        @error('jadwal_tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700 mb-1">Interview Time</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                            <input type="time" name="jadwal_waktu" id="jadwal_waktu" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        @error('jadwal_waktu')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-4 rounded-lg border border-purple-100 shadow-sm">
                <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-star-half-alt text-indigo-500 mr-2"></i> Evaluation Scores
                </h4>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="kualifikasi_skor" class="block text-sm font-medium text-gray-700 mb-1">Qualification Score (1-5)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-graduate text-gray-400"></i>
                            </div>
                            <input type="number" name="kualifikasi_skor" id="kualifikasi_skor" min="1" max="5" value="1" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 text-sm">/5</span>
                            </div>
                        </div>
                        @error('kualifikasi_skor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="komunikasi_skor" class="block text-sm font-medium text-gray-700 mb-1">Communication Score (1-5)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-comments text-gray-400"></i>
                            </div>
                            <input type="number" name="komunikasi_skor" id="komunikasi_skor" min="1" max="5" value="1" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 text-sm">/5</span>
                            </div>
                        </div>
                        @error('komunikasi_skor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <label for="sikap_skor" class="block text-sm font-medium text-gray-700 mb-1">Attitude Score (1-5)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-smile text-gray-400"></i>
                            </div>
                            <input type="number" name="sikap_skor" id="sikap_skor" min="1" max="5" value="1" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 text-sm">/5</span>
                            </div>
                        </div>
                        @error('sikap_skor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Hidden field for status_seleksi with default value -->
            <input type="hidden" name="status_seleksi" value="Pending">

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-save mr-2"></i> Schedule Interview
                </button>
                <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
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
