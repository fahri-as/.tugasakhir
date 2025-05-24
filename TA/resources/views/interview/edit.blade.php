<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-edit text-indigo-600 mr-2"></i> {{ __('Edit Interview') }}
            </h2>
            <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('interview.update', $interview) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-id-card text-indigo-600 mr-2"></i> Basic Information
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="pelamar_id" class="block text-sm font-medium text-gray-700 mb-1">Applicant</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <select name="pelamar_id" id="pelamar_id" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            @foreach($pelamar as $p)
                                                <option value="{{ $p->pelamar_id }}" @selected($p->pelamar_id == $interview->pelamar_id)>
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
                        </div>

                        <!-- Interview Schedule -->
                        <div class="bg-gradient-to-r from-gray-50 to-indigo-50 p-4 rounded-lg border border-gray-200 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i> Interview Schedule
                            </h3>

                            <div class="transform transition duration-200 hover:-translate-y-1">
                                <label for="jadwal" class="block text-sm font-medium text-gray-700 mb-1">Schedule Date & Time</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-clock text-gray-400"></i>
                                    </div>
                                    <input type="datetime-local" name="jadwal" id="jadwal" value="{{ old('jadwal', $interview->jadwal->format('Y-m-d\TH:i')) }}" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                @error('jadwal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Evaluation Scores -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg border border-blue-100 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-star-half-alt text-purple-500 mr-2"></i> Evaluation Scores
                            </h3>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                                <div class="transform transition duration-200 hover:-translate-y-1">
                                    <label for="kualifikasi_skor" class="block text-sm font-medium text-gray-700 mb-1">Qualification Score (1-5)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user-graduate text-gray-400"></i>
                                        </div>
                                        <input type="number" name="kualifikasi_skor" id="kualifikasi_skor" value="{{ old('kualifikasi_skor', $interview->kualifikasi_skor) }}" min="1" max="5" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                                        <input type="number" name="komunikasi_skor" id="komunikasi_skor" value="{{ old('komunikasi_skor', $interview->komunikasi_skor) }}" min="1" max="5" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                                        <input type="number" name="sikap_skor" id="sikap_skor" value="{{ old('sikap_skor', $interview->sikap_skor) }}" min="1" max="5" required class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 text-sm">/5</span>
                                        </div>
                                    </div>
                                    @error('sikap_skor')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="bg-gradient-to-r from-gray-50 to-purple-50 p-3 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h5 class="text-sm font-medium text-gray-700 flex items-center">
                                            <i class="fas fa-calculator text-purple-500 mr-2"></i> Total Score
                                        </h5>
                                        <span class="text-lg font-bold text-purple-700">
                                            {{ number_format(($interview->kualifikasi_skor + $interview->komunikasi_skor + $interview->sikap_skor) / 3, 2) }}/5
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Interview Status -->
                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-lg border border-yellow-100 shadow-sm mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <i class="fas fa-flag-checkered text-amber-500 mr-2"></i> Interview Status
                            </h3>

                            <div class="transform transition duration-200 hover:-translate-y-1">
                                <label for="status_seleksi" class="block text-sm font-medium text-gray-700 mb-1">Current Status</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tasks text-gray-400"></i>
                                    </div>
                                    <input type="text" value="{{ $interview->status_seleksi }}" class="pl-10 block w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" readonly>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Status cannot be changed directly. Use the action buttons on the interview details page.</p>
                            </div>
                        </div>

                        <!-- Hidden field for status_seleksi to maintain the current value -->
                        <input type="hidden" name="status_seleksi" value="{{ $interview->status_seleksi }}">

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-600 hover:to-indigo-700 active:bg-purple-800 focus:outline-none focus:border-purple-700 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                                <i class="fas fa-save mr-2"></i> Update Interview
                            </button>
                            <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
