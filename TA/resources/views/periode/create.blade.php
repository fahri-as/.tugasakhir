<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-calendar-plus text-indigo-600 mr-2"></i> {{ __('Create Period') }}
            </h2>
            <div>
                <a href="{{ route('periode.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 transform hover:scale-105 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-calendar-plus text-indigo-600 mr-2"></i> Create New Period
                            </h3>
                        </div>

                        <div class="p-6">
                            <form action="{{ route('periode.store') }}" method="POST" class="space-y-6">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Period Name -->
                                    <div class="col-span-full">
                                        <label for="nama_periode" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fas fa-calendar-alt text-gray-500 mr-1"></i> Period Name
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-tag text-gray-400"></i>
                                            </div>
                                            <input type="text" name="nama_periode" id="nama_periode" required
                                                class="pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('nama_periode') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                                placeholder="e.g. January-June 2023 Internship Period" value="{{ old('nama_periode') }}">
                                        </div>
                                        @error('nama_periode')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Start Date -->
                                    <div>
                                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fas fa-calendar-day text-gray-500 mr-1"></i> Start Date
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-calendar-plus text-gray-400"></i>
                                            </div>
                                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" required
                                                class="pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('tanggal_mulai') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                                value="{{ old('tanggal_mulai') }}">
                                        </div>
                                        @error('tanggal_mulai')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- End Date -->
                                    <div>
                                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fas fa-calendar-check text-gray-500 mr-1"></i> End Date
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-calendar-minus text-gray-400"></i>
                                            </div>
                                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" required
                                                class="pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('tanggal_selesai') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                                value="{{ old('tanggal_selesai') }}">
                                        </div>
                                        @error('tanggal_selesai')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Duration -->
                                    <div>
                                        <label for="durasi_minggu_magang" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fas fa-hourglass-half text-gray-500 mr-1"></i> Internship Duration (Weeks)
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-clock text-gray-400"></i>
                                            </div>
                                            <input type="number" name="durasi_minggu_magang" id="durasi_minggu_magang" required min="1"
                                                class="pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('durasi_minggu_magang') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                                placeholder="e.g. 12" value="{{ old('durasi_minggu_magang') }}">
                                        </div>
                                        @error('durasi_minggu_magang')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="col-span-full">
                                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                                            <i class="fas fa-align-left text-gray-500 mr-1"></i> Description
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('deskripsi') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                                placeholder="Provide a detailed description of this internship period...">{{ old('deskripsi') }}</textarea>
                                        </div>
                                        @error('deskripsi')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Available Jobs -->
                                <div class="pt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-briefcase text-gray-500 mr-1"></i> Available Jobs
                                        <span class="ml-1 text-xs text-gray-500">(Select which jobs should be available during this period)</span>
                                    </label>

                                    <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                                            @forelse($jobs as $job)
                                                <div class="relative flex items-start bg-white p-3 rounded-md border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 transition-colors duration-200">
                                                    <div class="flex items-center h-5">
                                                        <input type="checkbox" name="jobs[]" id="job_{{ $job->job_id }}" value="{{ $job->job_id }}"
                                                            @checked(old('jobs') && in_array($job->job_id, old('jobs')))
                                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                    </div>
                                                    <div class="ml-3 text-sm">
                                                        <label for="job_{{ $job->job_id }}" class="font-medium text-gray-700">{{ $job->nama_job }}</label>
                                                        <p class="text-gray-500 line-clamp-1">{{ Str::limit($job->deskripsi, 40) }}</p>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-span-full bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0">
                                                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-sm text-yellow-700">
                                                                No jobs available. <a href="{{ route('jobs.create') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">Create jobs</a> first.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                    @error('jobs')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Form Actions -->
                                <div class="pt-6 border-t border-gray-200">
                                    <div class="flex justify-end items-center gap-4">
                                        <a href="{{ route('periode.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                                            <i class="fas fa-times mr-2"></i> Cancel
                                        </a>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                                            <i class="fas fa-save mr-2"></i> Create Period
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
