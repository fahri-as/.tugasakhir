<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-user-circle text-indigo-600 mr-2"></i> {{ __('Applicant Details') }}
            </h2>
            <div>
                <!-- Interview Button - Only show if no interview exists and status is not already Interview -->
                @if(!$pelamar->interview && $pelamar->status_seleksi !== 'Interview')
                <button id="scheduleInterviewBtn" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                    <i class="fas fa-calendar-check mr-2"></i> Schedule Interview
                </button>
                @endif
                <a href="{{ route('pelamar.edit', $pelamar) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                    <i class="fas fa-edit mr-2"></i> Edit Applicant
                </a>
                <a href="{{ route('pelamar.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
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
                                    <h3 class="text-xl font-bold text-gray-800">{{ $pelamar->nama }}</h3>
                                    <p class="text-gray-600 flex items-center">
                                        <i class="fas fa-briefcase text-indigo-400 mr-2"></i>
                                        {{ $pelamar->job ? $pelamar->job->nama_job : 'No position assigned' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col items-start md:items-end">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full mb-2
                                    @if($pelamar->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                    @if($pelamar->status_seleksi === 'Interview') bg-blue-100 text-blue-800 @endif
                                    @if($pelamar->status_seleksi === 'Sedang Berjalan') bg-green-100 text-green-800 @endif">
                                    <i class="fas
                                        @if($pelamar->status_seleksi === 'Pending') fa-clock @endif
                                        @if($pelamar->status_seleksi === 'Interview') fa-user-tie @endif
                                        @if($pelamar->status_seleksi === 'Sedang Berjalan') fa-check-circle @endif
                                        mr-1"></i>
                                    {{ $pelamar->status_seleksi ?? 'Pending' }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Applied: {{ $pelamar->created_at ? $pelamar->created_at->format('d M Y') : 'Unknown' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center border-b pb-2">
                            <i class="fas fa-id-card text-indigo-600 mr-2"></i> Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">ID</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->pelamar_id }}</p>
                            </div>
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Full Name</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->nama }}</p>
                            </div>
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->email }}</p>
                            </div>
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">WhatsApp Number</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->nomor_wa }}</p>
                            </div>
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Date of Birth</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->tgl_lahir ? $pelamar->tgl_lahir->format('d F Y') : '-' }}</p>
                            </div>
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Education</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->pendidikan ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2 transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Address</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Application Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center border-b pb-2">
                            <i class="fas fa-clipboard-list text-indigo-600 mr-2"></i> Application Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                            <div class="transform transition hover:-translate-y-1 duration-200">
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
                            <div class="transform transition hover:-translate-y-1 duration-200">
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
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">CV</p>
                                <p class="mt-1 text-sm">
                                    @if($pelamar->berkas_cv)
                                        <a href="{{ url($pelamar->berkas_cv) }}" target="_blank" class="text-blue-600 hover:text-blue-800 flex items-center">
                                            <i class="fas fa-file-pdf mr-1 text-red-500"></i>
                                            View CV
                                        </a>
                                    @else
                                        <span class="text-gray-500">No CV uploaded</span>
                                    @endif
                                </p>
                            </div>
                            <!-- In the Application Details section -->
                            <div class="transform transition hover:-translate-y-1 duration-200">
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
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center border-b pb-2">
                            <i class="fas fa-briefcase text-indigo-600 mr-2"></i> Work Experience
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Experience Duration</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    @if($pelamar->lama_pengalaman)
                                        <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">
                                            {{ $pelamar->lama_pengalaman }} {{ Str::plural('year', $pelamar->lama_pengalaman) }}
                                        </span>
                                    @else
                                        No experience
                                    @endif
                                </p>
                            </div>
                            <div class="transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Previous Workplace</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->tempat_pengalaman ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2 transform transition hover:-translate-y-1 duration-200">
                                <p class="text-sm font-medium text-gray-500">Workplace Description</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $pelamar->deskripsi_tempat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Selection Process -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center border-b pb-2">
                            <i class="fas fa-tasks text-indigo-600 mr-2"></i> Selection Process
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Interview -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-100 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow">
                                <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                                    <i class="fas fa-comments text-blue-500 mr-2"></i> Interview
                                </h4>
                                @if($pelamar->interview)
                                    <div class="space-y-2 bg-white p-3 rounded-md">
                                        <p class="text-sm flex items-center">
                                            <span class="w-36 text-gray-500">Date:</span>
                                            <span class="font-medium">{{ $pelamar->interview->jadwal ? $pelamar->interview->jadwal->format('d M Y') : 'Not scheduled' }}</span>
                                        </p>
                                        <p class="text-sm flex items-center">
                                            <span class="w-36 text-gray-500">Time:</span>
                                            <span class="font-medium">{{ $pelamar->interview->jadwal ? $pelamar->interview->jadwal->format('H:i') : 'Not scheduled' }}</span>
                                        </p>
                                        <p class="text-sm flex items-center">
                                            <span class="w-36 text-gray-500">Qualification Score:</span>
                                            <span class="font-medium">{{ $pelamar->interview->kualifikasi_skor }}/5</span>
                                        </p>
                                        <p class="text-sm flex items-center">
                                            <span class="w-36 text-gray-500">Communication Score:</span>
                                            <span class="font-medium">{{ $pelamar->interview->komunikasi_skor }}/5</span>
                                        </p>
                                        <p class="text-sm flex items-center">
                                            <span class="w-36 text-gray-500">Attitude Score:</span>
                                            <span class="font-medium">{{ $pelamar->interview->sikap_skor }}/5</span>
                                        </p>
                                        <p class="text-sm flex items-center font-medium">
                                            <span class="w-36 text-gray-500">Total Score:</span>
                                            <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-800 text-xs">{{ $pelamar->interview->total_skor }}/5</span>
                                        </p>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center bg-white p-4 rounded-md opacity-70">
                                        <i class="fas fa-calendar-times text-gray-400 text-3xl mb-2"></i>
                                        <p class="text-sm text-gray-500 italic">No interview conducted yet</p>
                                        @if($pelamar->status_seleksi !== 'Interview')
                                            <button id="scheduleInterviewBtnInline" class="mt-3 px-3 py-1 bg-blue-500 text-white rounded-md text-xs hover:bg-blue-600 focus:outline-none">
                                                Schedule Now
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Skill Test -->
                            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-4 border border-purple-100 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow">
                                <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                                    <i class="fas fa-clipboard-check text-purple-500 mr-2"></i> Skill Test
                                </h4>
                                @if($pelamar->tesKemampuan)
                                    <div class="space-y-2 bg-white p-3 rounded-md">
                                        <p class="text-sm flex items-center">
                                            <span class="w-28 text-gray-500">Date:</span>
                                            <span class="font-medium">{{ $pelamar->tesKemampuan->jadwal ? $pelamar->tesKemampuan->jadwal->format('d M Y') : 'Not scheduled' }}</span>
                                        </p>
                                        <p class="text-sm flex items-center">
                                            <span class="w-28 text-gray-500">Time:</span>
                                            <span class="font-medium">{{ $pelamar->tesKemampuan->jadwal ? $pelamar->tesKemampuan->jadwal->format('H:i') : 'Not scheduled' }}</span>
                                        </p>
                                        <p class="text-sm flex items-center">
                                            <span class="w-28 text-gray-500">Score:</span>
                                            <span class="px-2 py-1 rounded-full bg-purple-100 text-purple-800 text-xs font-medium">{{ $pelamar->tesKemampuan->skor }}/100</span>
                                        </p>
                                        @if($pelamar->tesKemampuan->catatan)
                                            <p class="text-sm">
                                                <span class="block text-gray-500 mb-1">Notes:</span>
                                                <span class="block pl-4 border-l-2 border-gray-200 italic">{{ $pelamar->tesKemampuan->catatan }}</span>
                                            </p>
                                        @endif
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center bg-white p-4 rounded-md opacity-70">
                                        <i class="fas fa-vial text-gray-400 text-3xl mb-2"></i>
                                        <p class="text-sm text-gray-500 italic">No skill test conducted yet</p>
                                    </div>
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
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-indigo-500 mr-2"></i> Schedule Interview
                </h3>
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
                        </div>

                        <!-- Submit/Cancel buttons -->
                        <div class="mt-6 flex justify-between">
                            <button type="button" id="cancelInterviewBtn" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                                Cancel
                            </button>
                            <button type="submit" id="submitInterviewBtn" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-base font-medium text-white hover:from-indigo-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                                Schedule Interview
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('interviewModal');
            const openModalBtn = document.getElementById('scheduleInterviewBtn');
            const openModalBtnInline = document.getElementById('scheduleInterviewBtnInline');
            const closeModalBtn = document.getElementById('cancelInterviewBtn');
            const dateInput = document.getElementById('jadwal_tanggal');
            const dateError = document.getElementById('date_error');
            const submitBtn = document.getElementById('submitInterviewBtn');

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

            if (openModalBtnInline) {
                openModalBtnInline.addEventListener('click', showModal);
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
            dateInput.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const now = new Date();
                now.setHours(0, 0, 0, 0);

                if (selectedDate < now) {
                    dateError.classList.remove('hidden');
                    submitBtn.disabled = true;
                } else {
                    dateError.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</x-app-layout>
