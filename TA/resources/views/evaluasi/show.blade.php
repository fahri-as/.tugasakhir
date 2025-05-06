<x-crud-layout title="Weekly Evaluation Details">
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900">Evaluation Information</h3>
            <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Evaluation ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $evaluasi->evaluasi_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Week</dt>
                    <dd class="mt-1 text-sm text-gray-900">Week {{ $evaluasi->minggu_ke }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Intern Information</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <div>Name: {{ $evaluasi->magang->pelamar->nama }}</div>
                        <div>Position: {{ $evaluasi->magang->pelamar->job->nama_job }}</div>
                        <div>Email: {{ $evaluasi->magang->pelamar->email }}</div>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Evaluation Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $evaluasi->tanggal_evaluasi->format('d M Y') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Weekly Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($evaluasi->skor_minggu, 2) }}/5</dd>
                </div>
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-900">Evaluation Criteria Scores</h3>
            <div class="mt-4 overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 lg:grid-cols-5">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Criteria 1</dt>
                            <dd class="mt-1 text-xl font-semibold text-gray-900">{{ $evaluasi->kriteria1 }}/5</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Criteria 2</dt>
                            <dd class="mt-1 text-xl font-semibold text-gray-900">{{ $evaluasi->kriteria2 }}/5</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Criteria 3</dt>
                            <dd class="mt-1 text-xl font-semibold text-gray-900">{{ $evaluasi->kriteria3 }}/5</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Criteria 4</dt>
                            <dd class="mt-1 text-xl font-semibold text-gray-900">{{ $evaluasi->kriteria4 }}/5</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Criteria 5</dt>
                            <dd class="mt-1 text-xl font-semibold text-gray-900">{{ $evaluasi->kriteria5 }}/5</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('evaluasi.edit', $evaluasi) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Edit Evaluation
            </a>
            <form action="{{ route('evaluasi.destroy', $evaluasi) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this evaluation?')">
                    Delete Evaluation
                </button>
            </form>
            <a href="{{ route('evaluasi.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Back to List
            </a>
        </div>
    </div>
</x-crud-layout>
