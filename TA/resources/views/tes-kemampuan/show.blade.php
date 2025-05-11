<x-crud-layout title="Skill Test Details">
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
            <!-- Status update buttons based on current status -->
            @if($tesKemampuan->status_seleksi === 'Pending')
                <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                    <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                    <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                    <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                    <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                    <input type="hidden" name="status_seleksi" value="Lulus">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                        Mark as Passed
                    </button>
                </form>
                <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                    <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                    <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                    <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                    <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                    <input type="hidden" name="status_seleksi" value="Tidak Lulus">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                        Mark as Failed
                    </button>
                </form>
            @elseif($tesKemampuan->status_seleksi === 'Lulus')
                <form action="{{ route('tes-kemampuan.update', $tesKemampuan) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pelamar_id" value="{{ $tesKemampuan->pelamar_id }}">
                    <input type="hidden" name="user_id" value="{{ $tesKemampuan->user_id }}">
                    <input type="hidden" name="skor" value="{{ $tesKemampuan->skor }}">
                    <input type="hidden" name="catatan" value="{{ $tesKemampuan->catatan }}">
                    <input type="hidden" name="jadwal" value="{{ $tesKemampuan->jadwal->format('Y-m-d\TH:i') }}">
                    <input type="hidden" name="status_seleksi" value="Magang">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                        Move to Internship
                    </button>
                </form>
            @endif

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
</x-crud-layout>
