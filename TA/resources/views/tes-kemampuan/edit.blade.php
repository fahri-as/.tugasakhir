<x-crud-layout title="Edit Skill Test" icon="fa-edit">
    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-lg border border-purple-100 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
            <i class="fas fa-edit text-purple-600 mr-2"></i> Update Test Details
        </h3>

        <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="transform transition duration-200 hover:-translate-y-1">
                    <label for="tes_id" class="block text-sm font-medium text-gray-700 mb-1">Test ID</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-hashtag text-gray-400"></i>
                        </div>
                        <input type="text" id="tes_id" value="{{ $tesKemampuan->tes_id }}" class="pl-10 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm focus:border-purple-500 focus:ring-purple-500" readonly>
                    </div>
                </div>

                <div class="transform transition duration-200 hover:-translate-y-1">
                    <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">Applicant</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <select name="pelamar_id" id="pelamar_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            @foreach($pelamar as $p)
                                <option value="{{ $p->pelamar_id }}" @selected($p->pelamar_id == $tesKemampuan->pelamar_id)>
                                    {{ $p->nama }} - {{ $p->job->nama_job }} ({{ $p->periode->nama_periode }})
                                </option>
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
                            @foreach($users as $user)
                                <option value="{{ $user->user_id }}" @selected($user->user_id == $tesKemampuan->user_id)>
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
                    <i class="fas fa-calendar-alt text-purple-500 mr-2"></i> Test Schedule
                </h4>

                <div class="transform transition duration-200 hover:-translate-y-1">
                    <label for="jadwal" class="block text-sm font-medium text-gray-700 mb-1">Schedule Date & Time</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-clock text-gray-400"></i>
                        </div>
                        <input type="datetime-local" name="jadwal" id="jadwal" value="{{ old('jadwal', $tesKemampuan->jadwal->format('Y-m-d\TH:i')) }}" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    </div>
                    @error('jadwal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                            <input type="number" name="skor" id="skor" value="{{ old('skor', $tesKemampuan->skor) }}" min="0" max="100" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
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
                                <option value="Pending" @selected($tesKemampuan->status_seleksi == 'Pending')>Pending</option>
                                <option value="Tidak Lulus" @selected($tesKemampuan->status_seleksi == 'Tidak Lulus')>Tidak Lulus</option>
                                <option value="Lulus" @selected($tesKemampuan->status_seleksi == 'Lulus')>Lulus</option>
                                <option value="Magang" @selected($tesKemampuan->status_seleksi == 'Magang')>Magang</option>
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
                            <textarea name="catatan" id="catatan" rows="3" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">{{ old('catatan', $tesKemampuan->catatan) }}</textarea>
                        </div>
                        @error('catatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <div class="bg-gradient-to-r from-gray-50 to-purple-50 p-3 rounded-lg border border-gray-200">
                        <div class="flex justify-between items-center">
                            <h5 class="text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-calculator text-purple-500 mr-2"></i> Current Score
                            </h5>
                            <span class="text-lg font-bold text-purple-700">
                                {{ $tesKemampuan->skor }}/100
                            </span>
                        </div>
                        <div class="mt-2">
                            <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                @php
                                    $scorePercentage = $tesKemampuan->skor;
                                    $scoreColor = 'bg-red-500';
                                    if ($scorePercentage >= 80) {
                                        $scoreColor = 'bg-green-500';
                                    } elseif ($scorePercentage >= 60) {
                                        $scoreColor = 'bg-blue-500';
                                    } elseif ($scorePercentage >= 40) {
                                        $scoreColor = 'bg-yellow-500';
                                    }
                                @endphp
                                <div class="{{ $scoreColor }}" style="width: {{ $scorePercentage }}%; height: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-lg border border-yellow-100 shadow-sm">
                <h4 class="text-md font-medium text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-info-circle text-amber-500 mr-2"></i> Test Information
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-3 rounded-md shadow-sm">
                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <p class="text-sm font-medium text-gray-500">Created</p>
                        <p class="mt-1 text-sm text-gray-900 flex items-center">
                            <i class="fas fa-calendar-plus text-gray-400 mr-1"></i>
                            {{ $tesKemampuan->created_at->format('d M Y H:i:s') }}
                        </p>
                    </div>
                    <div class="transform transition duration-200 hover:-translate-y-1">
                        <p class="text-sm font-medium text-gray-500">Last Updated</p>
                        <p class="mt-1 text-sm text-gray-900 flex items-center">
                            <i class="fas fa-clock text-gray-400 mr-1"></i>
                            {{ $tesKemampuan->updated_at->format('d M Y H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-600 hover:to-indigo-700 active:bg-purple-800 focus:outline-none focus:border-purple-700 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-save mr-2"></i> Update Test
                </button>
                <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</x-crud-layout>