<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Details') }}
            </h2>
            <div>
                <!-- Interview Button - Only show if no interview exists and status is not already Interview -->
                @if(!$pelamar->interview && $pelamar->status_seleksi !== 'Interview')
                <button id="scheduleInterviewBtn" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                    Schedule Interview
                </button>
                @endif
                <a href="{{ route('pelamar.edit', $pelamar) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                    Edit Applicant
                </a>
                <a href="{{ route('pelamar.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Applicant Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">ID</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->pelamar_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Full Name</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">WhatsApp Number</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->nomor_wa }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Date of Birth</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->tgl_lahir ? $pelamar->tgl_lahir->format('d F Y') : '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Education</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->pendidikan ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Address</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Application Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Position Applied</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    @if($pelamar->job)
                                        {{ $pelamar->job->nama_job }}
                                        @if($pelamar->job->deskripsi)
                                            <span class="text-gray-500">({{ $pelamar->job->deskripsi }})</span>
                                        @endif
                                    @else
                                        Not assigned
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Period</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    @if($pelamar->periode)
                                        {{ $pelamar->periode->nama_periode }}
                                        <span class="text-gray-500">({{ $pelamar->periode->tanggal_mulai->format('d M Y') }} - {{ $pelamar->periode->tanggal_selesai->format('d M Y') }})</span>
                                    @else
                                        Not assigned
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">CV</p>
                                <p class="mt-1 text-sm">
                                    @if($pelamar->berkas_cv)
                                        <a href="{{ url($pelamar->berkas_cv) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            View CV
                                        </a>
                                    @else
                                        No CV uploaded
                                    @endif
                                </p>
                            </div>
                            <!-- In the Application Details section -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Selection Status</p>
                                <p class="mt-1 text-sm">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($pelamar->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                        @if($pelamar->status_seleksi === 'Interview') bg-blue-100 text-blue-800 @endif
                                        @if($pelamar->status_seleksi === 'Sedang Berjalan') bg-green-100 text-green-800 @endif">
                                        {{ $pelamar->status_seleksi ?? 'Pending' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Experience Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Work Experience</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Experience Duration</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    @if($pelamar->lama_pengalaman)
                                        {{ $pelamar->lama_pengalaman }} {{ Str::plural('year', $pelamar->lama_pengalaman) }}
                                    @else
                                        No experience
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Previous Workplace</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->tempat_pengalaman ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Workplace Description</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->deskripsi_tempat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Selection Process -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Selection Process</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Interview -->
                            <div class="border rounded-lg p-4">
                                <h4 class="font-medium text-gray-700 mb-2">Interview</h4>
                                @if($pelamar->interview)
                                    <div class="space-y-2">
                                        <p class="text-sm">
                                            <span class="text-gray-500">Date:</span>
                                            {{ $pelamar->interview->jadwal ? $pelamar->interview->jadwal->format('d M Y') : 'Not scheduled' }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="text-gray-500">Time:</span>
                                            {{ $pelamar->interview->jadwal ? $pelamar->interview->jadwal->format('H:i') : 'Not scheduled' }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="text-gray-500">Qualification Score:</span>
                                            {{ $pelamar->interview->kualifikasi_skor }}/5
                                        </p>
                                        <p class="text-sm">
                                            <span class="text-gray-500">Communication Score:</span>
                                            {{ $pelamar->interview->komunikasi_skor }}/5
                                        </p>
                                        <p class="text-sm">
                                            <span class="text-gray-500">Attitude Score:</span>
                                            {{ $pelamar->interview->sikap_skor }}/5
                                        </p>
                                        <p class="text-sm font-medium">
                                            <span class="text-gray-500">Total Score:</span>
                                            {{ $pelamar->interview->total_skor }}/5
                                        </p>
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 italic">No interview conducted yet</p>
                                @endif
                            </div>

                            <!-- Skill Test -->
                            <div class="border rounded-lg p-4">
                                <h4 class="font-medium text-gray-700 mb-2">Skill Test</h4>
                                @if($pelamar->tesKemampuan)
                                    <div class="space-y-2">
                                        <p class="text-sm">
                                            <span class="text-gray-500">Date:</span>
                                            {{ $pelamar->tesKemampuan->jadwal ? $pelamar->tesKemampuan->jadwal->format('d M Y') : 'Not scheduled' }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="text-gray-500">Time:</span>
                                            {{ $pelamar->tesKemampuan->jadwal ? $pelamar->tesKemampuan->jadwal->format('H:i') : 'Not scheduled' }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="text-gray-500">Score:</span>
                                            {{ $pelamar->tesKemampuan->skor }}/100
                                        </p>
                                        @if($pelamar->tesKemampuan->catatan)
                                            <p class="text-sm">
                                                <span class="text-gray-500">Notes:</span>
                                                {{ $pelamar->tesKemampuan->catatan }}
                                            </p>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 italic">No skill test conducted yet</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interview Scheduling Modal - With date and time input and validation -->
    <div id="interviewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Schedule Interview</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="interviewForm" action="{{ route('interview.schedule') }}" method="POST">
                        @csrf
                        <!-- Hidden fields for applicant data -->
                        <input type="hidden" name="pelamar_id" value="{{ $pelamar->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <!-- Interview Date and Time -->
                        <div class="mb-4">
                            <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700 text-left mb-1">Interview Date</label>
                            <input type="date" name="jadwal_tanggal" id="jadwal_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <p id="date_error" class="mt-1 text-xs text-red-600 hidden">Please select a future date</p>
                        </div>

                        <div class="mb-4">
                            <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700 text-left mb-1">Interview Time</label>
                            <input type="time" name="jadwal_waktu" id="jadwal_waktu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <p id="time_error" class="mt-1 text-xs text-red-600 hidden">Please select a future time</p>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="button" id="cancelInterviewBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                Cancel
                            </button>
                            <button type="submit" id="scheduleBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Schedule
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal Control with Time Validation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get modal elements
            const modal = document.getElementById('interviewModal');
            const openModalBtn = document.getElementById('scheduleInterviewBtn');
            const closeModalBtn = document.getElementById('cancelInterviewBtn');
            const scheduleBtn = document.getElementById('scheduleBtn');
            const interviewForm = document.getElementById('interviewForm');

            // Get date and time inputs
            const jadwalDateInput = document.getElementById('jadwal_tanggal');
            const jadwalTimeInput = document.getElementById('jadwal_waktu');

            // Get error messages
            const dateError = document.getElementById('date_error');
            const timeError = document.getElementById('time_error');

            // Set min date for interview to today
            const today = new Date();
            const formattedToday = today.toISOString().split('T')[0];
            jadwalDateInput.min = formattedToday;
            jadwalDateInput.value = formattedToday;

            // Set default time (current time + 1 hour, rounded to next 30 minute slot)
            let defaultHour = today.getHours() + 1;
            let defaultMinutes = today.getMinutes() < 30 ? 30 : 0;

            // If we're past 30 minutes and we added an hour
            if (today.getMinutes() >= 30) {
                defaultHour += 1;
            }

            // Adjust for next day if it's late in the day
            if (defaultHour >= 24) {
                defaultHour = 9; // Default to 9 AM next day
                defaultMinutes = 0;

                // Set date to tomorrow
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                jadwalDateInput.value = tomorrow.toISOString().split('T')[0];
            }

            // Format the time as HH:MM
            const formattedHour = String(defaultHour).padStart(2, '0');
            const formattedMinutes = String(defaultMinutes).padStart(2, '0');
            jadwalTimeInput.value = `${formattedHour}:${formattedMinutes}`;

            // Function to validate the datetime is in the future
            function validateDatetime() {
                const selectedDate = new Date(jadwalDateInput.value);
                const now = new Date();

                // Reset error messages
                dateError.classList.add('hidden');
                timeError.classList.add('hidden');

                let isValid = true;

                // Check if date is today
                if (selectedDate.toDateString() === now.toDateString()) {
                    // If today, check if time is in the future
                    const [hours, minutes] = jadwalTimeInput.value.split(':').map(Number);
                    const selectedTime = new Date();
                    selectedTime.setHours(hours, minutes, 0, 0);

                    if (selectedTime <= now) {
                        timeError.classList.remove('hidden');
                        isValid = false;
                    }
                } else if (selectedDate < now && selectedDate.toDateString() !== now.toDateString()) {
                    // Date is in the past
                    dateError.classList.remove('hidden');
                    isValid = false;
                }

                return isValid;
            }

            // Validate on initial load
            validateDatetime();

            // Add event listeners for date and time changes
            jadwalDateInput.addEventListener('change', validateDatetime);
            jadwalTimeInput.addEventListener('change', validateDatetime);

            // Prevent form submission if validation fails
            interviewForm.addEventListener('submit', function(event) {
                if (!validateDatetime()) {
                    event.preventDefault();
                }
            });

            // Modal open function
            if (openModalBtn) {
                openModalBtn.addEventListener('click', function() {
                    modal.classList.remove('hidden');
                    validateDatetime(); // Re-validate when opening modal
                });
            }

            // Modal close function
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });
            }

            // Close modal if clicked outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
