<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Details') }}
            </h2>
            <div>
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
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="mt-1 text-sm">
                                    @if($pelamar->magang)
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($pelamar->magang->status_seleksi === 'Lulus') bg-green-100 text-green-800 @endif
                                            @if($pelamar->magang->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                            @if($pelamar->magang->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                            @if($pelamar->magang->status_seleksi === 'Sedang Berjalan') bg-blue-100 text-blue-800 @endif
                                            @if($pelamar->magang->status_seleksi === 'Selesai') bg-gray-100 text-gray-800 @endif">
                                            {{ $pelamar->magang->status_seleksi }}
                                        </span>
                                        @if($pelamar->magang->rank)
                                            <span class="ml-2 text-gray-500">Rank: {{ $pelamar->magang->rank }}</span>
                                        @endif
                                    @else
                                        <span class="text-gray-500">Not processed</span>
                                    @endif
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
</x-app-layout>
