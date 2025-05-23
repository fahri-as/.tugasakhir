<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-comments text-indigo-600 mr-2"></i> {{ __('Interview Details') }}
            </h2>
            <div>
                @if($interview->status_seleksi !== 'Tes Kemampuan')
                    <button id="scheduleTestBtn" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md {{ $interview->status_seleksi === 'Tes Kemampuan' ? 'hidden' : '' }}">
                        <i class="fas fa-vial mr-2"></i> Schedule Skill Test
                    </button>
                    @if($interview->status_seleksi === 'Tidak Lulus')
                        <form action="{{ route('interview.update', $interview) }}" method="POST" class="inline" id="resetForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="pelamar_id" value="{{ $interview->pelamar_id }}">
                            <input type="hidden" name="user_id" value="{{ $interview->user_id }}">
                            <input type="hidden" name="kualifikasi_skor" value="{{ $interview->kualifikasi_skor }}">
                            <input type="hidden" name="komunikasi_skor" value="{{ $interview->komunikasi_skor }}">
                            <input type="hidden" name="sikap_skor" value="{{ $interview->sikap_skor }}">
                            <input type="hidden" name="jadwal" value="{{ $interview->jadwal->format('Y-m-d\TH:i') }}">
                            <input type="hidden" name="status_seleksi" value="Pending">
                            <input type="hidden" name="send_email" value="1">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-yellow-600 hover:to-amber-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                                <i class="fas fa-redo-alt mr-2"></i> Reset to Pending
                            </button>
                        </form>
                    @else
                        <form action="{{ route('interview.update', $interview) }}" method="POST" class="inline" id="failForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="pelamar_id" value="{{ $interview->pelamar_id }}">
                            <input type="hidden" name="user_id" value="{{ $interview->user_id }}">
                            <input type="hidden" name="kualifikasi_skor" value="{{ $interview->kualifikasi_skor }}">
                            <input type="hidden" name="komunikasi_skor" value="{{ $interview->komunikasi_skor }}">
                            <input type="hidden" name="sikap_skor" value="{{ $interview->sikap_skor }}">
                            <input type="hidden" name="jadwal" value="{{ $interview->jadwal->format('Y-m-d\TH:i') }}">
                            <input type="hidden" name="status_seleksi" value="Tidak Lulus">
                            <input type="hidden" name="send_email" value="1">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                                <i class="fas fa-times-circle mr-2"></i> Mark as Failed
                            </button>
                        </form>
                    @endif
                @endif

                <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-green-50" role="alert">
                            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md mb-4 flex items-center transform transition-all duration-300 hover:bg-red-50" role="alert">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3 text-lg"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Applicant Status Card -->
                    <div class="mb-6 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-lg p-4 border border-indigo-100 shadow-sm">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-center mb-3 md:mb-0">
                                <div class="h-16 w-16 rounded-full bg-indigo-100 border-2 border-indigo-200 flex items-center justify-center text-indigo-500 mr-4 shadow-sm">
                                    <i class="fas fa-user text-3xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">{{ $interview->pelamar->nama }}</h3>
                                    <p class="text-gray-600 flex items-center">
                                        <i class="fas fa-briefcase text-indigo-400 mr-2"></i>
                                        {{ $interview->pelamar->job ? $interview->pelamar->job->nama_job : 'No position assigned' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col items-start md:items-end">
                                <span class="px-3 py-1 inline-flex items-center text-sm leading-5 font-semibold rounded-full mb-2
                                    @if($interview->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                    @if($interview->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                    @if($interview->status_seleksi === 'Tes Kemampuan') bg-green-100 text-green-800 @endif">
                                    <i class="fas
                                        @if($interview->status_seleksi === 'Pending') fa-clock @endif
                                        @if($interview->status_seleksi === 'Tidak Lulus') fa-times-circle @endif
                                        @if($interview->status_seleksi === 'Tes Kemampuan') fa-check-circle @endif
                                        mr-1"></i>
                                    {{ $interview->status_seleksi }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Scheduled for: {{ $interview->jadwal->format('d M Y H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Interview Scores Card -->
                        <div class="md:col-span-2 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-100 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                                <i class="fas fa-chart-bar text-indigo-600 mr-2"></i> Interview Scores
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                                <!-- Qualification Score -->
                                <div class="bg-white rounded-lg p-3 shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="text-sm font-medium text-gray-500">Qualification</h4>
                                        <span class="font-bold text-lg">{{ $interview->kualifikasi_skor }}/5</span>
                                    </div>
                                    <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-blue-500" style="width: {{ ($interview->kualifikasi_skor / 5) * 100 }}%; height: 100%"></div>
                                    </div>
                                </div>

                                <!-- Communication Score -->
                                <div class="bg-white rounded-lg p-3 shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="text-sm font-medium text-gray-500">Communication</h4>
                                        <span class="font-bold text-lg">{{ $interview->komunikasi_skor }}/5</span>
                                    </div>
                                    <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-purple-500" style="width: {{ ($interview->komunikasi_skor / 5) * 100 }}%; height: 100%"></div>
                                    </div>
                                </div>

                                <!-- Attitude Score -->
                                <div class="bg-white rounded-lg p-3 shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="text-sm font-medium text-gray-500">Attitude</h4>
                                        <span class="font-bold text-lg">{{ $interview->sikap_skor }}/5</span>
                                    </div>
                                    <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-green-500" style="width: {{ ($interview->sikap_skor / 5) * 100 }}%; height: 100%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Score -->
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="text-base font-medium text-gray-700">Total Score</h4>
                                    <span class="font-bold text-xl">{{ number_format($interview->total_skor, 2) }}/5</span>
                                </div>
                                <div class="h-3 w-full bg-gray-200 rounded-full overflow-hidden">
                                    @php
                                        $scorePercentage = ($interview->total_skor / 5) * 100;
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

                                <div class="mt-2 text-center">
                                    <span class="text-sm text-gray-500">
                                        @if($scorePercentage >= 80)
                                            <span class="text-green-700 font-medium">Excellent</span> - Highly recommended for next stage
                                        @elseif($scorePercentage >= 60)
                                            <span class="text-blue-700 font-medium">Good</span> - Recommended with some reservations
                                        @elseif($scorePercentage >= 40)
                                            <span class="text-yellow-700 font-medium">Average</span> - Consider carefully
                                        @else
                                            <span class="text-red-700 font-medium">Below Average</span> - Not recommended
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Interviewer Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-lg p-4 border border-gray-200 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                                <i class="fas fa-user-tie text-indigo-600 mr-2"></i> Interviewer
                            </h3>
                            <div class="space-y-3 bg-white p-3 rounded-md shadow-sm">
                                <div class="flex items-center">
                                    <span class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $interview->user->username }}</p>
                                        <p class="text-xs text-gray-500">{{ $interview->user->role }}</p>
                                    </div>
                                </div>
                                <div class="border-t pt-3">
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-calendar-check text-gray-400 mr-1"></i>
                                        Created: {{ $interview->created_at->format('d M Y H:i:s') }}
                                    </p>
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-clock text-gray-400 mr-1"></i>
                                        Updated: {{ $interview->updated_at->format('d M Y H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Information Section -->
                    <div class="mb-6 bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-4 border border-purple-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                            <i class="fas fa-id-card text-indigo-600 mr-2"></i> Applicant Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Contact Information</h4>
                                <div class="bg-white p-3 rounded-md shadow-sm">
                                    <p class="text-sm flex items-center">
                                        <i class="fas fa-envelope text-gray-400 w-5 mr-1"></i>
                                        <span class="font-medium">{{ $interview->pelamar->email }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fab fa-whatsapp text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $interview->pelamar->nomor_wa }}</span>
                                    </p>
                                    <p class="text-sm flex items-start mt-1">
                                        <i class="fas fa-map-marker-alt text-gray-400 w-5 mr-1 mt-1"></i>
                                        <span>{{ $interview->pelamar->alamat }}</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Personal Details</h4>
                                <div class="bg-white p-3 rounded-md shadow-sm">
                                    <p class="text-sm flex items-center">
                                        <i class="fas fa-birthday-cake text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $interview->pelamar->tgl_lahir ? $interview->pelamar->tgl_lahir->format('d F Y') : '-' }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-graduation-cap text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $interview->pelamar->pendidikan ?? '-' }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-clock text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $interview->pelamar->lama_pengalaman ?? 0 }} years experience</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Application</h4>
                                <div class="bg-white p-3 rounded-md shadow-sm">
                                    <p class="text-sm flex items-center">
                                        <i class="fas fa-briefcase text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $interview->pelamar->job->nama_job }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-calendar text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $interview->pelamar->periode->nama_periode }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-file-pdf text-gray-400 w-5 mr-1"></i>
                                        @if($interview->pelamar->berkas_cv)
                                            <a href="{{ url($interview->pelamar->berkas_cv) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View CV</a>
                                        @else
                                            <span class="text-gray-500">No CV uploaded</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <a href="{{ route('interview.edit', $interview) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-blue-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                            <i class="fas fa-edit mr-2"></i> Edit Interview
                        </a>
                        <form action="{{ route('interview.destroy', $interview) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md" onclick="return confirm('Are you sure you want to delete this interview?')">
                                <i class="fas fa-trash mr-2"></i> Delete Interview
                            </button>
                        </form>
                        <a href="{{ route('pelamar.show', $interview->pelamar) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                            <i class="fas fa-user mr-2"></i> View Applicant
                        </a>
                        <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                            <i class="fas fa-arrow-left mr-2"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skill Test Scheduling Modal -->
    <div id="skillTestModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center justify-center">
                    <i class="fas fa-vial text-indigo-500 mr-2"></i> Schedule Skill Test
                </h3>
                <div class="mt-2 px-7 py-3">
                    <form id="skillTestForm" action="{{ route('tes-kemampuan.store') }}" method="POST">
                        @csrf
                        <!-- Hidden fields for applicant data -->
                        <input type="hidden" name="pelamar_id" value="{{ $interview->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ $interview->user_id }}">
                        <input type="hidden" name="skor" value="0">
                        <input type="hidden" name="catatan" value="">
                        <input type="hidden" name="status_seleksi" value="Pending">
                        <input type="hidden" name="send_email" value="1">

                        <!-- Skill Test Date and Time -->
                        <div class="mb-4">
                            <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700 text-left mb-1">Test Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                </div>
                                <input type="date" name="jadwal_tanggal" id="test_jadwal_tanggal" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>
                            <p id="test_date_error" class="mt-1 text-xs text-red-600 hidden">Please select a future date</p>
                        </div>

                        <div class="mb-4">
                            <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700 text-left mb-1">Test Time</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div>
                                <input type="time" name="jadwal_waktu" id="test_jadwal_waktu" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>
                            <p id="test_time_error" class="mt-1 text-xs text-red-600 hidden">Please select a future time</p>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="button" id="cancelTestBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                Cancel
                            </button>
                            <button type="submit" id="scheduleTestSubmitBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-blue-600 border border-transparent rounded-md hover:from-indigo-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Schedule Test
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('skillTestModal');
            const openModalBtn = document.getElementById('scheduleTestBtn');
            const closeModalBtn = document.getElementById('cancelTestBtn');
            const dateInput = document.getElementById('test_jadwal_tanggal');
            const dateError = document.getElementById('test_date_error');
            const timeInput = document.getElementById('test_jadwal_waktu');
            const timeError = document.getElementById('test_time_error');
            const submitBtn = document.getElementById('scheduleTestSubmitBtn');

            // Set minimum date to today
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            dateInput.setAttribute('min', formattedDate);

            // Show modal function
            const showModal = () => {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };

            // Hide modal function
            const hideModal = () => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            // Open modal
            if (openModalBtn) {
                openModalBtn.addEventListener('click', showModal);
            }

            // Close modal
            closeModalBtn.addEventListener('click', hideModal);

            // Close when clicking outside modal content
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    hideModal();
                }
            });

            // Validate date is in the future
            dateInput.addEventListener('change', validateDateTime);
            timeInput.addEventListener('change', validateDateTime);

            function validateDateTime() {
                const selectedDate = new Date(dateInput.value);
                const now = new Date();

                // If date is today, check the time too
                if (selectedDate.toDateString() === now.toDateString()) {
                    if (timeInput.value) {
                        const [hours, minutes] = timeInput.value.split(':');
                        selectedDate.setHours(hours, minutes);

                        if (selectedDate <= now) {
                            timeError.classList.remove('hidden');
                            submitBtn.disabled = true;
                            return;
                        } else {
                            timeError.classList.add('hidden');
                        }
                    }
                }

                // Check if the date is in the past
                if (selectedDate.toDateString() < now.toDateString()) {
                    dateError.classList.remove('hidden');
                    submitBtn.disabled = true;
                } else {
                    dateError.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            }
        });
    </script>
</x-app-layout>
