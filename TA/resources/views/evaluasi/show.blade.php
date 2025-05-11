<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluation Details') }}
            </h2>
            <div>
                <a href="{{ route('evaluasi.edit', $evaluasi) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit Evaluation
                </a>
                <a href="{{ route('evaluasi.index', ['periode_id' => $evaluasi->magang->pelamar->periode_id ?? '']) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Back to Evaluations
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column - Evaluation Info -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Evaluation Information</h3>

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Evaluation ID</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $evaluasi->evaluasi_id }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Week</p>
                                    <p class="mt-1 text-sm text-gray-900">Week {{ $evaluasi->minggu_ke }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Rating</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $evaluasi->ratingScale->name }} ({{ $evaluasi->ratingScale->singkatan }})
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Score (0-5 scale)</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $evaluasi->skor_minggu }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Created At</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $evaluasi->created_at->format('d M Y, H:i') }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Last Updated</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $evaluasi->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Intern Info -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Intern Information</h3>

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Intern ID</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $evaluasi->magang->magang_id }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Name</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $evaluasi->magang->pelamar->nama }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Position</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $evaluasi->magang->pelamar->job->nama_job ?? 'Not assigned' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Period</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($evaluasi->magang->pelamar->periode)
                                            {{ $evaluasi->magang->pelamar->periode->nama_periode }}
                                            ({{ $evaluasi->magang->pelamar->periode->tanggal_mulai->format('d M Y') }} -
                                            {{ $evaluasi->magang->pelamar->periode->tanggal_selesai->format('d M Y') }})
                                        @else
                                            Not assigned
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $evaluasi->magang->pelamar->email }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <p class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($evaluasi->magang->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800
                                            @elseif($evaluasi->magang->status_seleksi === 'Lulus') bg-green-100 text-green-800
                                            @elseif($evaluasi->magang->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800
                                            @elseif($evaluasi->magang->status_seleksi === 'Sedang Berjalan') bg-blue-100 text-blue-800
                                            @endif">
                                            {{ $evaluasi->magang->status_seleksi }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('magang.show', $evaluasi->magang) }}" class="text-indigo-600 hover:text-indigo-900">
                                    View Intern's Full Details →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
