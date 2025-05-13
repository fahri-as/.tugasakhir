<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Skill Test Details') }}
            </h2>
            <div>
                @php
                    // Check if the job is specifically Cooks (JOB001) or Pastry Chef (JOB004)
                    $isCookOrPastry = false;
                    if ($tesKemampuan->pelamar && $tesKemampuan->pelamar->job) {
                        $jobId = $tesKemampuan->pelamar->job->job_id;
                        $isCookOrPastry = ($jobId === 'JOB001' || $jobId === 'JOB004');
                    }
                @endphp

                @if($tesKemampuan->status_seleksi === 'Pending')
                    @if($isCookOrPastry)
                        {{-- For Cook & Pastry, show Move to Internship button - Modified to use JS modal --}}
                        <button id="moveToInternshipBtn" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            Move to Internship
                        </button>
                    @else
                        {{-- For other positions, show Mark as Passed --}}
                        <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                            <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                            <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                            <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                            <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                            <input type="hidden" name="status_seleksi" value="Lulus">
                            <input type="hidden" name="redirect" value="show">
                            <input type="hidden" name="send_email" value="1">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                                Mark as Passed
                            </button>
                        </form>
                    @endif

                    {{-- Show Mark as Failed for all positions --}}
                    <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                        <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                        <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                        <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="status_seleksi" value="Tidak Lulus">
                        <input type="hidden" name="redirect" value="show">
                        <input type="hidden" name="send_email" value="1">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            Mark as Failed
                        </button>
                    </form>
                @elseif($tesKemampuan->status_seleksi === 'Lulus')
                    <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="inline" id="resetForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                        <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                        <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                        <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="status_seleksi" value="Pending">
                        <input type="hidden" name="redirect" value="show">
                        <input type="hidden" name="send_email" value="1">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            Reset to Pending
                        </button>
                    </form>
                @elseif($tesKemampuan->status_seleksi === 'Tidak Lulus')
                    <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="inline" id="resetForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                        <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                        <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                        <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="status_seleksi" value="Pending">
                        <input type="hidden" name="redirect" value="show">
                        <input type="hidden" name="send_email" value="1">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            Reset to Pending
                        </button>
                    </form>
                @endif

                <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Test Information</h3>
                            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Test ID</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tesKemampuan->tes_id }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Schedule Date & Time</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tesKemampuan->jadwal->format('d M Y H:i') }}</dd>
                                </div>

                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Applicant Information</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <div>Name: {{ $tesKemampuan->pelamar->nama }}</div>
                                        <div>Position: {{ $tesKemampuan->pelamar->job->nama_job }}</div>
                                        <div>Email: {{ $tesKemampuan->pelamar->email }}</div>
                                        <div>Phone: {{ $tesKemampuan->pelamar->nomor_wa }}</div>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Assigned To</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tesKemampuan->user->username }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Selection Status</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($tesKemampuan->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                            @if($tesKemampuan->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                            @if($tesKemampuan->status_seleksi === 'Lulus') bg-green-100 text-green-800 @endif
                                            @if($tesKemampuan->status_seleksi === 'Magang') bg-blue-100 text-blue-800 @endif">
                                            {{ $tesKemampuan->status_seleksi }}
                                        </span>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Score</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tesKemampuan->skor }}/100</dd>
                                </div>

                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tesKemampuan->catatan ?: 'No notes provided' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tesKemampuan->created_at->format('d M Y H:i:s') }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $tesKemampuan->updated_at->format('d M Y H:i:s') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-4">
                            <a href="{{ route('tes-kemampuan.edit', $tesKemampuan) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Edit Test
                            </a>
                            <form action="{{ route('tes-kemampuan.destroy', $tesKemampuan) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this test?')">
                                    Delete Test
                                </button>
                            </form>
                            <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Internship Start Date Modal -->
    <div id="internshipModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Schedule Internship Start</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="internshipForm" action="{{ route('magang.schedule-start', ['tesKemampuan' => $tesKemampuan->tes_id]) }}" method="POST">
                        @csrf
                        <!-- Hidden fields for applicant data -->
                        <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                        <input type="hidden" name="tes_id" value="{{ $tesKemampuan->tes_id }}">
                        <input type="hidden" name="send_email" value="1">

                        <!-- Internship Start Date and Time -->
                        <div class="mb-4">
                            <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700 text-left mb-1">Start Date</label>
                            <input type="date" name="jadwal_tanggal" id="jadwal_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <p id="date_error" class="mt-1 text-xs text-red-600 hidden">Please select a future date</p>
                        </div>

                        <div class="mb-4">
                            <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700 text-left mb-1">Start Time</label>
                            <input type="time" name="jadwal_waktu" id="jadwal_waktu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <p id="time_error" class="mt-1 text-xs text-red-600 hidden">Please select a future time</p>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="button" id="cancelInternshipBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                Cancel
                            </button>
                            <button type="submit" id="scheduleBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Schedule Start
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
            const modal = document.getElementById('internshipModal');
            const openModalBtn = document.getElementById('moveToInternshipBtn');
            const closeModalBtn = document.getElementById('cancelInternshipBtn');
            const scheduleBtn = document.getElementById('scheduleBtn');
            const internshipForm = document.getElementById('internshipForm');

            // Get date and time inputs
            const jadwalDateInput = document.getElementById('jadwal_tanggal');
            const jadwalTimeInput = document.getElementById('jadwal_waktu');

            // Get error messages
            const dateError = document.getElementById('date_error');
            const timeError = document.getElementById('time_error');

            // Set min date for internship to today
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
            internshipForm.addEventListener('submit', function(event) {
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
