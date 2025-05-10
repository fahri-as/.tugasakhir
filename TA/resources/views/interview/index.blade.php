<x-crud-layout title="Interview Management" :createRoute="route('interview.create')">
    <!-- Period Filter -->
    <div class="mb-6">
        <form action="{{ route('interview.index') }}" method="GET" class="flex items-end space-x-4">
            <div>
                <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Period</label>
                <select id="periode_filter" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">All Periods</option>
                    @php
                        $latestPeriode = App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
                        $latestPeriodeId = $latestPeriode ? $latestPeriode->periode_id : '';
                        $selectedPeriodeId = request('periode_id') !== null ? request('periode_id') : $latestPeriodeId;
                        $sortBy = request('sort_by', 'total_skor');
                        $sortDir = request('sort_dir', 'desc');
                    @endphp
                    @foreach(App\Models\Periode::orderBy('tanggal_mulai', 'desc')->get() as $periode)
                        <option value="{{ $periode->periode_id }}" {{ $selectedPeriodeId == $periode->periode_id ? 'selected' : '' }}>
                            {{ $periode->nama_periode }} ({{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Filter
                </button>

                @if(request()->has('periode_id') || request()->has('sort_by'))
                    <a href="{{ route('interview.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'interview_id', 'sort_dir' => $sortBy == 'interview_id' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            ID
                            @if($sortBy == 'interview_id')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'pelamar_nama', 'sort_dir' => $sortBy == 'pelamar_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Applicant
                            @if($sortBy == 'pelamar_nama')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'job_nama', 'sort_dir' => $sortBy == 'job_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Job Position
                            @if($sortBy == 'job_nama')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'periode_nama', 'sort_dir' => $sortBy == 'periode_nama' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Period
                            @if($sortBy == 'periode_nama')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'jadwal', 'sort_dir' => $sortBy == 'jadwal' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Schedule
                            @if($sortBy == 'jadwal')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'total_skor', 'sort_dir' => $sortBy == 'total_skor' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Total Score
                            @if($sortBy == 'total_skor' || (!request('sort_by') && !request('sort_dir')))
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ route('interview.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'status_seleksi', 'sort_dir' => $sortBy == 'status_seleksi' && $sortDir == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                            Status
                            @if($sortBy == 'status_seleksi')
                                @if($sortDir == 'asc')
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="ml-1 h-3 w-3 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($interviews as $interview)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $interview->interview_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $interview->pelamar->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $interview->pelamar->job->nama_job }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $interview->pelamar->periode->nama_periode }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $interview->jadwal->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($interview->total_skor, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($interview->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                @if($interview->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                @if($interview->status_seleksi === 'Tes Kemampuan') bg-green-100 text-green-800 @endif">
                                {{ $interview->status_seleksi }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('interview.show', $interview) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                            <a href="{{ route('interview.edit', $interview) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('interview.destroy', $interview) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this interview?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No interviews found. Schedule your first interview!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-crud-layout>
