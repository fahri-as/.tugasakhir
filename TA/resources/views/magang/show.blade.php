<x-crud-layout title="Internship Details">
    <div class="space-y-8">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Internship Information</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Internship ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $magang->magang_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Selection Status</dt>
                    <dd class="mt-1 text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $magang->status_seleksi === 'Sedang Berjalan' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $magang->status_seleksi === 'Lulus' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $magang->status_seleksi === 'Tidak Lulus' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $magang->status_seleksi === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                            {{ $magang->status_seleksi }}
                        </span>
                    </dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Intern Information</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <div>Name: {{ $magang->pelamar->nama }}</div>
                        <div>Position: {{ $magang->pelamar->job->nama_job ?? 'Not Assigned' }}</div>
                        <div>Email: {{ $magang->pelamar->email }}</div>
                        <div>Phone: {{ $magang->pelamar->nomor_wa }}</div>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Start Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($magang->jadwal_mulai)
                            {{ $magang->jadwal_mulai->format('d F Y') }} at {{ $magang->jadwal_mulai->format('H:i') }}
                        @else
                            <span class="text-gray-500 italic">Not scheduled yet</span>
                        @endif
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Supervisor</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $magang->user->username }} ({{ $magang->user->role }})</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($magang->total_skor, 2) }}/5</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Rank</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $magang->rank ?? 'Not ranked' }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Period</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $magang->pelamar->periode->nama_periode ?? 'Not Assigned' }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Internship Duration</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($magang->pelamar->periode && $magang->pelamar->periode->durasi_minggu_magang)
                            {{ $magang->pelamar->periode->durasi_minggu_magang }} {{ Str::plural('week', $magang->pelamar->periode->durasi_minggu_magang) }}
                        @else
                            <span class="text-gray-500 italic">Not specified</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        @if($magang->status_seleksi === 'Sedang Berjalan' && !$magang->jadwal_mulai)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        This internship is in progress but no start date has been set.
                        <a href="#" id="scheduleStartButton" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                            Schedule start date
                        </a>
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if($magang->evaluasiMingguan->count() > 0)
        <div>
            <h3 class="text-lg font-medium text-gray-900">Weekly Evaluations</h3>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Week</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($magang->evaluasiMingguan->sortBy('minggu_ke') as $evaluasi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Week {{ $evaluasi->minggu_ke }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $evaluasi->ratingScale->name ?? 'N/A' }}
                                    <span class="text-xs text-gray-500">({{ $evaluasi->ratingScale->singkatan ?? 'N/A' }})</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($evaluasi->skor_minggu, 2) }}/5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $evaluasi->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('evaluasi.show', $evaluasi) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                    <a href="{{ route('evaluasi.edit', $evaluasi) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-900">Evaluation Summary</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Average Weekly Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ number_format($magang->evaluasiMingguan->avg('skor_minggu'), 2) }}/5
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Highest Weekly Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ number_format($magang->evaluasiMingguan->max('skor_minggu'), 2) }}/5
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Evaluated Weeks</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $magang->evaluasiMingguan->count() }}
                        @if($magang->pelamar->periode && $magang->pelamar->periode->durasi_minggu_magang)
                            of {{ $magang->pelamar->periode->durasi_minggu_magang }}
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
        @else
        <div class="bg-gray-50 p-4 rounded-md">
            <p class="text-sm text-gray-500 italic">No weekly evaluations have been recorded yet.</p>
        </div>
        @endif

        <div class="flex flex-wrap items-center gap-4">
            <a href="{{ route('magang.edit', $magang) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Edit Record
            </a>

            <form action="{{ route('magang.updateStatus', $magang) }}" method="POST" class="inline">
                @csrf
                @method('PUT')
                <input type="hidden" name="status_seleksi" value="{{ $magang->status_seleksi == 'Sedang Berjalan' ? 'Lulus' : 'Sedang Berjalan' }}">
                <button type="submit" class="inline-flex items-center px-4 py-2
                    {{ $magang->status_seleksi == 'Sedang Berjalan' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-green-600 hover:bg-green-700' }}
                    rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                    {{ $magang->status_seleksi == 'Sedang Berjalan' ? 'Mark as Completed' : 'Start Internship' }}
                </button>
            </form>

            <form action="{{ route('magang.destroy', $magang) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this internship record? This will also reset the related skill test status.')">
                    Delete Record
                </button>
            </form>

            <a href="{{ route('magang.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Back to List
            </a>

            @if($magang->status_seleksi === 'Sedang Berjalan')
            <a href="{{ route('evaluasi.create', ['magang_id' => $magang->magang_id, 'minggu_ke' => $magang->evaluasiMingguan->count() + 1]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                Add Weekly Evaluation
            </a>
            @endif
        </div>
    </div>

    <!-- Start Date Scheduling Modal -->
    <div id="scheduleStartModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('magang.scheduleStart', $magang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Schedule Internship Start Date
                                </h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="jadwal_tanggal" class="block text-sm font-medium text-gray-700">
                                            Start Date
                                        </label>
                                        <input type="date" name="jadwal_tanggal" id="jadwal_tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    </div>
                                    <div>
                                        <label for="jadwal_waktu" class="block text-sm font-medium text-gray-700">
                                            Start Time
                                        </label>
                                        <input type="time" name="jadwal_waktu" id="jadwal_waktu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Schedule
                        </button>
                        <button type="button" id="cancelScheduleBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scheduleStartButton = document.getElementById('scheduleStartButton');
            const scheduleStartModal = document.getElementById('scheduleStartModal');
            const cancelScheduleBtn = document.getElementById('cancelScheduleBtn');
            const jadwalTanggalInput = document.getElementById('jadwal_tanggal');
            const jadwalWaktuInput = document.getElementById('jadwal_waktu');

            if (scheduleStartButton) {
                scheduleStartButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    scheduleStartModal.classList.remove('hidden');

                    // Set default date to today
                    const today = new Date();
                    jadwalTanggalInput.value = today.toISOString().split('T')[0];

                    // Set default time to current hour
                    const hours = String(today.getHours()).padStart(2, '0');
                    const minutes = String(today.getMinutes()).padStart(2, '0');
                    jadwalWaktuInput.value = `${hours}:${minutes}`;
                });
            }

            if (cancelScheduleBtn) {
                cancelScheduleBtn.addEventListener('click', function() {
                    scheduleStartModal.classList.add('hidden');
                });
            }

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === scheduleStartModal) {
                    scheduleStartModal.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
</x-crud-layout>
