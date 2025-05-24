<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-vial text-purple-600 mr-2"></i> {{ __('Skill Test Details') }}
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
                        <button id="moveToInternshipBtn" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-600 hover:to-cyan-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                            <i class="fas fa-graduation-cap mr-2"></i> Move to Internship
                        </button>
                    @else
                        {{-- For other positions, show Mark as Passed with modal --}}
                        <button id="markAsPassedBtn" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                            <i class="fas fa-check-circle mr-2"></i> Mark as Passed
                        </button>
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
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                            <i class="fas fa-times-circle mr-2"></i> Mark as Failed
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
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-yellow-600 hover:to-amber-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                            <i class="fas fa-redo-alt mr-2"></i> Reset to Pending
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
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-yellow-600 hover:to-amber-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2 transform hover:scale-105 shadow-md">
                            <i class="fas fa-redo-alt mr-2"></i> Reset to Pending
                        </button>
                    </form>
                @endif

                <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
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

                    <!-- Test Status Card -->
                    <div class="mb-6 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-4 border border-purple-100 shadow-sm">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-center mb-3 md:mb-0">
                                <div class="h-16 w-16 rounded-full bg-purple-100 border-2 border-purple-200 flex items-center justify-center text-purple-500 mr-4 shadow-sm">
                                    <i class="fas fa-vial text-3xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">{{ $tesKemampuan->pelamar->nama }}</h3>
                                    <p class="text-gray-600 flex items-center">
                                        <i class="fas fa-briefcase text-purple-400 mr-2"></i>
                                        {{ $tesKemampuan->pelamar->job ? $tesKemampuan->pelamar->job->nama_job : 'No position assigned' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col items-start md:items-end">
                                <span class="px-3 py-1 inline-flex items-center text-sm leading-5 font-semibold rounded-full mb-2
                                    @if($tesKemampuan->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                    @if($tesKemampuan->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                    @if($tesKemampuan->status_seleksi === 'Lulus') bg-green-100 text-green-800 @endif
                                    @if($tesKemampuan->status_seleksi === 'Magang') bg-blue-100 text-blue-800 @endif">
                                    <i class="fas
                                        @if($tesKemampuan->status_seleksi === 'Pending') fa-clock @endif
                                        @if($tesKemampuan->status_seleksi === 'Tidak Lulus') fa-times-circle @endif
                                        @if($tesKemampuan->status_seleksi === 'Lulus') fa-check-circle @endif
                                        @if($tesKemampuan->status_seleksi === 'Magang') fa-graduation-cap @endif
                                        mr-1"></i>
                                    {{ $tesKemampuan->status_seleksi }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Scheduled: {{ $tesKemampuan->jadwal->format('d M Y H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Test Score Card -->
                        <div class="md:col-span-2 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg p-4 border border-purple-100 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                                <i class="fas fa-chart-bar text-purple-600 mr-2"></i> Test Score Analysis
                            </h3>

                            <!-- Current Score Display -->
                            <div class="bg-white rounded-lg p-4 shadow-sm mb-4">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="text-base font-medium text-gray-700">Current Score</h4>
                                    <span class="font-bold text-2xl text-purple-700">{{ $tesKemampuan->skor }}/100</span>
                                </div>
                                <div class="h-4 w-full bg-gray-200 rounded-full overflow-hidden">
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

                                <div class="mt-3 text-center">
                                    <span class="text-sm text-gray-500">
                                        @if($scorePercentage >= 80)
                                            <span class="text-green-700 font-medium">Excellent Performance</span> - Highly recommended
                                        @elseif($scorePercentage >= 60)
                                            <span class="text-blue-700 font-medium">Good Performance</span> - Meets expectations
                                        @elseif($scorePercentage >= 40)
                                            <span class="text-yellow-700 font-medium">Fair Performance</span> - Needs improvement
                                        @else
                                            <span class="text-red-700 font-medium">Poor Performance</span> - Below expectations
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Score Breakdown -->
                            {{-- <div class="bg-white rounded-lg p-4 shadow-sm">
                                <h5 class="text-sm font-medium text-gray-700 mb-3">Performance Metrics</h5>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Technical Skills</span>
                                        <span class="text-sm font-medium">{{ min(100, $tesKemampuan->skor + 5) }}%</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Problem Solving</span>
                                        <span class="text-sm font-medium">{{ max(0, $tesKemampuan->skor - 10) }}%</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Time Management</span>
                                        <span class="text-sm font-medium">{{ $tesKemampuan->skor }}%</span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <!-- Test Supervisor Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-purple-50 rounded-lg p-4 border border-gray-200 shadow-sm transform transition duration-300 hover:-translate-y-1 hover:shadow">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                                <i class="fas fa-user-tie text-purple-600 mr-2"></i> Test Supervisor
                            </h3>
                            <div class="space-y-3 bg-white p-3 rounded-md shadow-sm">
                                <div class="flex items-center">
                                    <span class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-500">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $tesKemampuan->user->username }}</p>
                                        <p class="text-xs text-gray-500">{{ $tesKemampuan->user->role }}</p>
                                    </div>
                                </div>
                                <div class="border-t pt-3">
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-calendar-check text-gray-400 mr-1"></i>
                                        Created: {{ $tesKemampuan->created_at->format('d M Y H:i:s') }}
                                    </p>
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-clock text-gray-400 mr-1"></i>
                                        Updated: {{ $tesKemampuan->updated_at->format('d M Y H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Test Information Section -->
                    <div class="mb-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-4 border border-blue-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                            <i class="fas fa-clipboard-list text-purple-600 mr-2"></i> Test Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Test Details</h4>
                                <div class="bg-white p-3 rounded-md shadow-sm">
                                    <p class="text-sm flex items-center">
                                        <i class="fas fa-hashtag text-gray-400 w-5 mr-1"></i>
                                        <span class="font-medium">{{ $tesKemampuan->tes_id }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-calendar-alt text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $tesKemampuan->jadwal->format('d F Y') }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-clock text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $tesKemampuan->jadwal->format('H:i') }}</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Applicant Info</h4>
                                <div class="bg-white p-3 rounded-md shadow-sm">
                                    <p class="text-sm flex items-center">
                                        <i class="fas fa-user text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $tesKemampuan->pelamar->nama }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-envelope text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $tesKemampuan->pelamar->email }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fab fa-whatsapp text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $tesKemampuan->pelamar->nomor_wa }}</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-1">Position Applied</h4>
                                <div class="bg-white p-3 rounded-md shadow-sm">
                                    <p class="text-sm flex items-center">
                                        <i class="fas fa-briefcase text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $tesKemampuan->pelamar->job->nama_job }}</span>
                                    </p>
                                    <p class="text-sm flex items-center mt-1">
                                        <i class="fas fa-calendar text-gray-400 w-5 mr-1"></i>
                                        <span>{{ $tesKemampuan->pelamar->periode->nama_periode }}</span>
                                    </p>
                                    @if($tesKemampuan->pelamar->berkas_cv)
                                        <p class="text-sm flex items-center mt-1">
                                            <i class="fas fa-file-pdf text-gray-400 w-5 mr-1"></i>
                                            <a href="{{ url($tesKemampuan->pelamar->berkas_cv) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View CV</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Test Notes Section -->
                    @if($tesKemampuan->catatan)
                    <div class="mb-6 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg p-4 border border-amber-100 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center border-b pb-2">
                            <i class="fas fa-sticky-note text-amber-600 mr-2"></i> Test Notes
                        </h3>
                        <div class="bg-white p-4 rounded-md shadow-sm">
                            <p class="text-sm text-gray-700 italic leading-relaxed">{{ $tesKemampuan->catatan }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center space-x-2">
                        <a href="{{ route('tes-kemampuan.edit', $tesKemampuan) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-600 hover:to-indigo-700 active:bg-purple-800 focus:outline-none focus:border-purple-700 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                            <i class="fas fa-edit mr-2"></i> Edit Test
                        </a>
                        <form action="{{ route('tes-kemampuan.destroy', $tesKemampuan) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-rose-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md" onclick="return confirm('Are you sure you want to delete this test?')">
                                <i class="fas fa-trash mr-2"></i> Delete Test
                            </button>
                        </form>
                        <a href="{{ route('pelamar.show', $tesKemampuan->pelamar) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-600 hover:to-cyan-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                            <i class="fas fa-user mr-2"></i> View Applicant
                        </a>
                        <a href="{{ route('tes-kemampuan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 transform hover:scale-105">
                            <i class="fas fa-arrow-left mr-2"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Internship Start Date Modal -->
    <div id="internshipModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-blue-500 mr-2"></i> Schedule Internship Start
                </h3>
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
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                </div>
                                <input type="date" name="jadwal_tanggal" id="jadwal_tanggal" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                            <p id="date_error" class="mt-1 text-xs text-red-600 hidden">Please select a future date</p>
                        </div>

                        <div class="mb-4">
                            <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700 text-left mb-1">Start Time</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div>
                                <input type="time" name="jadwal_waktu" id="jadwal_waktu" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                            <p id="time_error" class="mt-1 text-xs text-red-600 hidden">Please select a future time</p>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="button" id="cancelInternshipBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-2">
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

    <!-- Contract Discussion Modal -->
    <div id="contractDiscussionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center justify-center">
                    <i class="fas fa-handshake text-green-500 mr-2"></i> Schedule Contract Discussion
                </h3>
                <div class="mt-2 px-7 py-3">
                    <form id="contractDiscussionForm" action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Hidden fields for applicant data -->
                        <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                        <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                        <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                        <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                        <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="status_seleksi" value="Lulus">
                        <input type="hidden" name="redirect" value="show">
                        <input type="hidden" name="send_email" value="1">

                        <!-- Contract Discussion Date and Time -->
                        <div class="mb-4">
                            <label for="kontrak_tanggal" class="block text-sm font-medium text-gray-700 text-left mb-1">Discussion Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                </div>
                                <input type="date" name="kontrak_tanggal" id="kontrak_tanggal" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                            </div>
                            <p id="kontrak_date_error" class="mt-1 text-xs text-red-600 hidden">Please select a future date</p>
                        </div>

                        <div class="mb-4">
                            <label for="kontrak_waktu" class="block text-sm font-medium text-gray-700 text-left mb-1">Discussion Time</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clock text-gray-400"></i>
                                </div>
                                <input type="time" name="kontrak_waktu" id="kontrak_waktu" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                            </div>
                            <p id="kontrak_time_error" class="mt-1 text-xs text-red-600 hidden">Please select a future time</p>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="button" id="cancelContractBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mr-2">
                                Cancel
                            </button>
                            <button type="submit" id="scheduleContractBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Schedule & Approve
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
            // Internship Modal elements
            const internshipModal = document.getElementById('internshipModal');
            const openInternshipModalBtn = document.getElementById('moveToInternshipBtn');
            const closeInternshipModalBtn = document.getElementById('cancelInternshipBtn');
            const internshipForm = document.getElementById('internshipForm');
            const jadwalDateInput = document.getElementById('jadwal_tanggal');
            const jadwalTimeInput = document.getElementById('jadwal_waktu');
            const dateError = document.getElementById('date_error');
            const timeError = document.getElementById('time_error');

            // Contract Discussion Modal elements
            const contractModal = document.getElementById('contractDiscussionModal');
            const openContractModalBtn = document.getElementById('markAsPassedBtn');
            const closeContractModalBtn = document.getElementById('cancelContractBtn');
            const contractForm = document.getElementById('contractDiscussionForm');
            const kontrakDateInput = document.getElementById('kontrak_tanggal');
            const kontrakTimeInput = document.getElementById('kontrak_waktu');
            const kontrakDateError = document.getElementById('kontrak_date_error');
            const kontrakTimeError = document.getElementById('kontrak_time_error');

            // Helper function to set default date and time values
            function setDefaultDateTime(dateInput, timeInput) {
                const today = new Date();
                const formattedToday = today.toISOString().split('T')[0];
                dateInput.min = formattedToday;
                dateInput.value = formattedToday;

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
                    dateInput.value = tomorrow.toISOString().split('T')[0];
                }

                // Format the time as HH:MM
                const formattedHour = String(defaultHour).padStart(2, '0');
                const formattedMinutes = String(defaultMinutes).padStart(2, '0');
                timeInput.value = `${formattedHour}:${formattedMinutes}`;
            }

            // Function to validate the datetime is in the future
            function validateDatetime(dateInput, timeInput, dateError, timeError) {
                const selectedDate = new Date(dateInput.value);
                const now = new Date();

                // Reset error messages
                dateError.classList.add('hidden');
                timeError.classList.add('hidden');

                let isValid = true;

                // Check if date is today
                if (selectedDate.toDateString() === now.toDateString()) {
                    // If today, check if time is in the future
                    const [hours, minutes] = timeInput.value.split(':').map(Number);
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

            // Setup Internship Modal
            if (jadwalDateInput && jadwalTimeInput) {
                setDefaultDateTime(jadwalDateInput, jadwalTimeInput);

                // Validate on initial load
                validateDatetime(jadwalDateInput, jadwalTimeInput, dateError, timeError);

                // Add event listeners for date and time changes
                jadwalDateInput.addEventListener('change', function() {
                    validateDatetime(jadwalDateInput, jadwalTimeInput, dateError, timeError);
                });

                jadwalTimeInput.addEventListener('change', function() {
                    validateDatetime(jadwalDateInput, jadwalTimeInput, dateError, timeError);
                });

                // Prevent form submission if validation fails
                if (internshipForm) {
                    internshipForm.addEventListener('submit', function(event) {
                        if (!validateDatetime(jadwalDateInput, jadwalTimeInput, dateError, timeError)) {
                            event.preventDefault();
                        }
                    });
                }

                // Modal open function
                if (openInternshipModalBtn) {
                    openInternshipModalBtn.addEventListener('click', function() {
                        internshipModal.classList.remove('hidden');
                        validateDatetime(jadwalDateInput, jadwalTimeInput, dateError, timeError);
                    });
                }

                // Modal close function
                if (closeInternshipModalBtn) {
                    closeInternshipModalBtn.addEventListener('click', function() {
                        internshipModal.classList.add('hidden');
                    });
                }

                // Close modal if clicked outside
                window.addEventListener('click', function(event) {
                    if (event.target === internshipModal) {
                        internshipModal.classList.add('hidden');
                    }
                });
            }

            // Setup Contract Discussion Modal
            if (kontrakDateInput && kontrakTimeInput) {
                setDefaultDateTime(kontrakDateInput, kontrakTimeInput);

                // Validate on initial load
                validateDatetime(kontrakDateInput, kontrakTimeInput, kontrakDateError, kontrakTimeError);

                // Add event listeners for date and time changes
                kontrakDateInput.addEventListener('change', function() {
                    validateDatetime(kontrakDateInput, kontrakTimeInput, kontrakDateError, kontrakTimeError);
                });

                kontrakTimeInput.addEventListener('change', function() {
                    validateDatetime(kontrakDateInput, kontrakTimeInput, kontrakDateError, kontrakTimeError);
                });

                // Prevent form submission if validation fails
                if (contractForm) {
                    contractForm.addEventListener('submit', function(event) {
                        if (!validateDatetime(kontrakDateInput, kontrakTimeInput, kontrakDateError, kontrakTimeError)) {
                            event.preventDefault();
                        }
                    });
                }

                // Modal open function
                if (openContractModalBtn) {
                    openContractModalBtn.addEventListener('click', function() {
                        contractModal.classList.remove('hidden');
                        validateDatetime(kontrakDateInput, kontrakTimeInput, kontrakDateError, kontrakTimeError);
                    });
                }

                // Modal close function
                if (closeContractModalBtn) {
                    closeContractModalBtn.addEventListener('click', function() {
                        contractModal.classList.add('hidden');
                    });
                }
                // Close modal if clicked outside
                window.addEventListener('click', function(event) {
                    if (event.target === contractModal) {
                        contractModal.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</x-app-layout>
