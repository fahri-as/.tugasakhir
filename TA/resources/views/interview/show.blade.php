<x-crud-layout title="Interview Details">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
            <button id="scheduleTestBtn" class="inline-flex items-center px-4 py-2 bg-green-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                Schedule Skill Test
            </button>
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
                <button type="button" id="failInterviewBtn" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                    Mark as Failed
                </button>
            </form>
        </div>
    </div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Details') }}
            </h2>

        </div>
    </x-slot>

    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Interview Information</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Interview ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->interview_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Schedule Date and Time</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->jadwal->format('d M Y H:i') }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Applicant Information</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <div>Name: {{ $interview->pelamar->nama }}</div>
                        <div>Position: {{ $interview->pelamar->job->nama_job }}</div>
                        <div>Period: {{ $interview->pelamar->periode->nama_periode }}</div>
                        <div>Email: {{ $interview->pelamar->email }}</div>
                        <div>Phone: {{ $interview->pelamar->nomor_wa }}</div>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Interviewer</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->user->username }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Selection Status</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($interview->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                            @if($interview->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                            @if($interview->status_seleksi === 'Tes Kemampuan') bg-green-100 text-green-800 @endif">
                            {{ $interview->status_seleksi }}
                        </span>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Qualification Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->kualifikasi_skor }}/5</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Communication Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->komunikasi_skor }}/5</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Attitude Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->sikap_skor }}/5</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Score</dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">{{ number_format($interview->total_skor, 2) }}/5</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->created_at->format('d M Y H:i:s') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $interview->updated_at->format('d M Y H:i:s') }}</dd>
                </div>
            </dl>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('interview.edit', $interview) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Edit Interview
            </a>
            <form action="{{ route('interview.destroy', $interview) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this interview?')">
                    Delete Interview
                </button>
            </form>
            <a href="{{ route('interview.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>

    <!-- Skill Test Scheduling Modal -->
    <div id="skillTestModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Schedule Skill Test</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="skillTestForm" action="{{ route('tes-kemampuan.store') }}" method="POST">
                        @csrf
                        <!-- Hidden fields for applicant data -->
                        <input type="hidden" name="pelamar_id" value="{{ $interview->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ $interview->user_id }}">

                        <!-- Skill Test Date and Time -->
                        <div class="mb-4">
                            <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700 text-left mb-1">Test Date</label>
                            <input type="date" name="jadwal_tanggal" id="test_jadwal_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <p id="test_date_error" class="mt-1 text-xs text-red-600 hidden">Please select a future date</p>
                        </div>

                        <div class="mb-4">
                            <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700 text-left mb-1">Test Time</label>
                            <input type="time" name="jadwal_waktu" id="test_jadwal_waktu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <p id="test_time_error" class="mt-1 text-xs text-red-600 hidden">Please select a future time</p>
                        </div>

                        <!-- Initial Score (can be updated later) -->
                        <div class="mb-4">
                            <label for="skor" class="block text-sm font-medium text-gray-700 text-left mb-1">Initial Score (0-100)</label>
                            <input type="number" name="skor" id="test_skor" min="0" max="100" value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 text-left mb-1">Notes (Optional)</label>
                            <textarea name="catatan" id="test_catatan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <!-- Hidden status field -->
                        <input type="hidden" name="status_seleksi" value="Pending">

                        <div class="flex justify-end mt-4">
                            <button type="button" id="cancelTestBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                                Cancel
                            </button>
                            <button type="submit" id="scheduleTestSubmitBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Schedule Test
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal Control and Form Submission -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fail interview button
            const failBtn = document.getElementById('failInterviewBtn');
            const failForm = document.getElementById('failForm');

            failBtn.addEventListener('click', function() {
                if (confirm('Are you sure you want to mark this interview as failed?')) {
                    failForm.submit();
                }
            });

            // Skill Test Modal
            const testModal = document.getElementById('skillTestModal');
            const openTestModalBtn = document.getElementById('scheduleTestBtn');
            const closeTestModalBtn = document.getElementById('cancelTestBtn');
            const skillTestForm = document.getElementById('skillTestForm');

            // Get date and time inputs for test
            const testDateInput = document.getElementById('test_jadwal_tanggal');
            const testTimeInput = document.getElementById('test_jadwal_waktu');

            // Get error messages
            const testDateError = document.getElementById('test_date_error');
            const testTimeError = document.getElementById('test_time_error');

            // Set min date for test to today
            const today = new Date();
            const formattedToday = today.toISOString().split('T')[0];
            testDateInput.min = formattedToday;
            testDateInput.value = formattedToday;

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
                testDateInput.value = tomorrow.toISOString().split('T')[0];
            }

            // Format the time as HH:MM
            const formattedHour = String(defaultHour).padStart(2, '0');
            const formattedMinutes = String(defaultMinutes).padStart(2, '0');
            testTimeInput.value = `${formattedHour}:${formattedMinutes}`;

            // Function to validate the datetime is in the future
            function validateTestDatetime() {
                const selectedDate = new Date(testDateInput.value);
                const now = new Date();

                // Reset error messages
                testDateError.classList.add('hidden');
                testTimeError.classList.add('hidden');

                let isValid = true;

                // Check if date is today
                if (selectedDate.toDateString() === now.toDateString()) {
                    // If today, check if time is in the future
                    const [hours, minutes] = testTimeInput.value.split(':').map(Number);
                    const selectedTime = new Date();
                    selectedTime.setHours(hours, minutes, 0, 0);

                    if (selectedTime <= now) {
                        testTimeError.classList.remove('hidden');
                        isValid = false;
                    }
                } else if (selectedDate < now && selectedDate.toDateString() !== now.toDateString()) {
                    // Date is in the past
                    testDateError.classList.remove('hidden');
                    isValid = false;
                }

                return isValid;
            }

            // Validate on initial load
            validateTestDatetime();

            // Add event listeners for date and time changes
            testDateInput.addEventListener('change', validateTestDatetime);
            testTimeInput.addEventListener('change', validateTestDatetime);

            // Prevent form submission if validation fails
            skillTestForm.addEventListener('submit', function(event) {
                if (!validateTestDatetime()) {
                    event.preventDefault();
                }

                // Also update the interview status when scheduling a test
                const updateForm = document.createElement('form');
                updateForm.method = 'POST';
                updateForm.action = '{{ route('interview.update', $interview) }}';
                updateForm.style.display = 'none';

                const csrfToken = document.createElement('input');
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                updateForm.appendChild(csrfToken);

                const methodField = document.createElement('input');
                methodField.name = '_method';
                methodField.value = 'PUT';
                updateForm.appendChild(methodField);

                // Copy all interview fields unchanged
                const fields = [
                    { name: 'pelamar_id', value: '{{ $interview->pelamar_id }}' },
                    { name: 'user_id', value: '{{ $interview->user_id }}' },
                    { name: 'kualifikasi_skor', value: '{{ $interview->kualifikasi_skor }}' },
                    { name: 'komunikasi_skor', value: '{{ $interview->komunikasi_skor }}' },
                    { name: 'sikap_skor', value: '{{ $interview->sikap_skor }}' },
                    { name: 'jadwal', value: '{{ $interview->jadwal->format('Y-m-d\TH:i') }}' },
                    { name: 'status_seleksi', value: 'Tes Kemampuan' }
                ];

                fields.forEach(field => {
                    const input = document.createElement('input');
                    input.name = field.name;
                    input.value = field.value;
                    updateForm.appendChild(input);
                });

                document.body.appendChild(updateForm);
                updateForm.submit();
            });

            // Modal open function
            openTestModalBtn.addEventListener('click', function() {
                testModal.classList.remove('hidden');
                validateTestDatetime(); // Re-validate when opening modal
            });

            // Modal close function
            closeTestModalBtn.addEventListener('click', function() {
                testModal.classList.add('hidden');
            });

            // Close modal if clicked outside
            window.addEventListener('click', function(event) {
                if (event.target === testModal) {
                    testModal.classList.add('hidden');
                }
            });
        });
    </script>
</x-crud-layout>
