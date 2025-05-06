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
                            {{ $magang->status_seleksi === 'accepted' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $magang->status_seleksi === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $magang->status_seleksi === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                            {{ ucfirst($magang->status_seleksi) }}
                        </span>
                    </dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Intern Information</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <div>Name: {{ $magang->pelamar->nama }}</div>
                        <div>Position: {{ $magang->pelamar->job->nama_job }}</div>
                        <div>Email: {{ $magang->pelamar->email }}</div>
                        <div>Phone: {{ $magang->pelamar->nomor_wa }}</div>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Score</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($magang->total_skor, 2) }}/5</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Period</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $magang->pelamar->periode->nama_periode }}</dd>
                </div>
            </dl>
        </div>

        @if($magang->evaluasiMingguan->count() > 0)
        <div>
            <h3 class="text-lg font-medium text-gray-900">Weekly Evaluations</h3>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Week</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($magang->evaluasiMingguan->sortBy('minggu_ke') as $evaluasi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Week {{ $evaluasi->minggu_ke }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($evaluasi->skor_minggu, 2) }}/5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('evaluasi.show', $evaluasi) }}" class="text-blue-600 hover:text-blue-900">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="flex items-center gap-4">
            <a href="{{ route('magang.edit', $magang) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Edit Record
            </a>
            <form action="{{ route('magang.destroy', $magang) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Are you sure you want to delete this internship record?')">
                    Delete Record
                </button>
            </form>
            <a href="{{ route('magang.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Back to List
            </a>
            <a href="{{ route('evaluasi.create', ['magang_id' => $magang->magang_id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                Add Weekly Evaluation
            </a>
        </div>
    </div>
</x-crud-layout>
