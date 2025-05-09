<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Management') }}
            </h2>
            <a href="{{ route('pelamar.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create New Applicant
            </a>
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

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Period Filter -->
                    <div class="mb-6">
                        <form action="{{ route('pelamar.index') }}" method="GET" class="flex items-end space-x-4">
                            <div>
                                <label for="periode_filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Period</label>
                                <select id="periode_filter" name="periode_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All Periods</option>
                                    @foreach(App\Models\Periode::all() as $periode)
                                        <option value="{{ $periode->periode_id }}" {{ request('periode_id') == $periode->periode_id ? 'selected' : '' }}>
                                            {{ $periode->nama_periode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Filter
                                </button>

                                @if(request()->has('periode_id') || request()->has('sort_by'))
                                    <a href="{{ route('pelamar.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    @if(count($pelamar) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'pelamar_id', 'sort_dir' => request('sort_by') == 'pelamar_id' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                ID
                                                @if(request('sort_by') == 'pelamar_id')
                                                    @if(request('sort_dir') == 'asc')
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
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'nama', 'sort_dir' => request('sort_by') == 'nama' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Name
                                                @if(request('sort_by') == 'nama')
                                                    @if(request('sort_dir') == 'asc')
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
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'job_id', 'sort_dir' => request('sort_by') == 'job_id' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Job
                                                @if(request('sort_by') == 'job_id')
                                                    @if(request('sort_dir') == 'asc')
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
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'periode_id', 'sort_dir' => request('sort_by') == 'periode_id' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Period
                                                @if(request('sort_by') == 'periode_id')
                                                    @if(request('sort_dir') == 'asc')
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
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'pendidikan', 'sort_dir' => request('sort_by') == 'pendidikan' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Education
                                                @if(request('sort_by') == 'pendidikan')
                                                    @if(request('sort_dir') == 'asc')
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
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'tgl_lahir', 'sort_dir' => request('sort_by') == 'tgl_lahir' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Birth Date
                                                @if(request('sort_by') == 'tgl_lahir')
                                                    @if(request('sort_dir') == 'asc')
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
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <a href="{{ route('pelamar.index', array_merge(request()->except(['sort_by', 'sort_dir']), ['sort_by' => 'lama_pengalaman', 'sort_dir' => request('sort_by') == 'lama_pengalaman' && request('sort_dir') == 'asc' ? 'desc' : 'asc'])) }}" class="group inline-flex items-center">
                                                Experience
                                                @if(request('sort_by') == 'lama_pengalaman')
                                                    @if(request('sort_dir') == 'asc')
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
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pelamar as $applicant)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $applicant->pelamar_id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $applicant->nama }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($applicant->job)
                                                    {{ $applicant->job->nama_job }}
                                                @else
                                                    <span class="text-gray-500">Not assigned</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($applicant->periode)
                                                    {{ $applicant->periode->nama_periode }}
                                                @else
                                                    <span class="text-gray-500">Not assigned</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($applicant->pendidikan)
                                                    {{ $applicant->pendidikan }}
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($applicant->tgl_lahir)
                                                    {{ $applicant->tgl_lahir->format('d M Y') }}
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($applicant->lama_pengalaman)
                                                    {{ $applicant->lama_pengalaman }} {{ Str::plural('year', $applicant->lama_pengalaman) }}
                                                @else
                                                    <span class="text-gray-500">No experience</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($applicant->magang)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        @if($applicant->magang->status_seleksi === 'Lulus') bg-green-100 text-green-800 @endif
                                                        @if($applicant->magang->status_seleksi === 'Tidak Lulus') bg-red-100 text-red-800 @endif
                                                        @if($applicant->magang->status_seleksi === 'Pending') bg-yellow-100 text-yellow-800 @endif
                                                        @if($applicant->magang->status_seleksi === 'Sedang Berjalan') bg-blue-100 text-blue-800 @endif
                                                        @if($applicant->magang->status_seleksi === 'Selesai') bg-gray-100 text-gray-800 @endif">
                                                        {{ $applicant->magang->status_seleksi }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-500">Not processed</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('pelamar.show', $applicant) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                                <a href="{{ route('pelamar.edit', $applicant) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                <form action="{{ route('pelamar.destroy', $applicant) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this applicant?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-gray-500">No applicants found. Create your first applicant!</p>
                            <a href="{{ route('pelamar.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">
                                Create New Applicant
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
