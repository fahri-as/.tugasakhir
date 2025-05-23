<x-crud-layout title="Period Details">
    <div class="space-y-6">
        <!-- Period Status Badge -->
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-calendar-alt text-indigo-600 mr-3"></i>{{ $periode->nama_periode }}
            </h2>
            <div>
                @if(now()->between($periode->tanggal_mulai, $periode->tanggal_selesai))
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-4 py-1.5 rounded-full flex items-center">
                        <i class="fas fa-play-circle mr-2"></i> Active
                    </span>
                @elseif($periode->tanggal_mulai->isFuture())
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-4 py-1.5 rounded-full flex items-center">
                        <i class="fas fa-hourglass-start mr-2"></i> Upcoming
                    </span>
                @else
                    <span class="bg-gray-100 text-gray-800 text-sm font-medium px-4 py-1.5 rounded-full flex items-center">
                        <i class="fas fa-check-circle mr-2"></i> Completed
                    </span>
                @endif
            </div>
        </div>

        <!-- Period Info Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle text-indigo-600 mr-2"></i> Period Information
                </h3>
            </div>
            <div class="p-6 bg-white">
                <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <dt class="text-sm font-medium text-blue-900 flex items-center">
                            <i class="fas fa-id-card text-blue-500 mr-2"></i> Period ID
                        </dt>
                        <dd class="mt-2 text-base font-semibold text-gray-900">{{ $periode->periode_id }}</dd>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <dt class="text-sm font-medium text-indigo-900 flex items-center">
                            <i class="fas fa-calendar-alt text-indigo-500 mr-2"></i> Period Name
                        </dt>
                        <dd class="mt-2 text-base font-semibold text-gray-900">{{ $periode->nama_periode }}</dd>
                    </div>

                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <dt class="text-sm font-medium text-purple-900 flex items-center">
                            <i class="fas fa-calendar-day text-purple-500 mr-2"></i> Start Date
                        </dt>
                        <dd class="mt-2 text-base font-semibold text-gray-900">{{ $periode->tanggal_mulai->format('d M Y') }}</dd>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg border border-green-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <dt class="text-sm font-medium text-green-900 flex items-center">
                            <i class="fas fa-calendar-check text-green-500 mr-2"></i> End Date
                        </dt>
                        <dd class="mt-2 text-base font-semibold text-gray-900">{{ $periode->tanggal_selesai->format('d M Y') }}</dd>
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <dt class="text-sm font-medium text-yellow-900 flex items-center">
                            <i class="fas fa-hourglass-half text-yellow-500 mr-2"></i> Internship Duration
                        </dt>
                        <dd class="mt-2 text-base font-semibold text-gray-900">{{ $periode->durasi_minggu_magang }} weeks</dd>
                    </div>

                    <div class="bg-red-50 p-4 rounded-lg border border-red-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <dt class="text-sm font-medium text-red-900 flex items-center">
                            <i class="fas fa-clock text-red-500 mr-2"></i> Created At
                        </dt>
                        <dd class="mt-2 text-base font-semibold text-gray-900">{{ $periode->created_at->format('d M Y H:i') }}</dd>
                    </div>

                    <div class="col-span-full bg-amber-50 p-4 rounded-lg border border-amber-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <dt class="text-sm font-medium text-amber-900 flex items-center">
                            <i class="fas fa-align-left text-amber-500 mr-2"></i> Description
                        </dt>
                        <dd class="mt-2 text-base text-gray-900">
                            {{ $periode->deskripsi ?: 'No description provided.' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Jobs Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-briefcase text-indigo-600 mr-2"></i> Available Jobs
                    <span class="ml-2 bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        {{ $periode->jobs->count() }}
                    </span>
                </h3>
            </div>
            <div class="p-6 bg-white">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($periode->jobs as $job)
                        <div class="flex flex-col bg-gradient-to-r from-gray-50 to-blue-50 p-5 rounded-lg border border-gray-200 shadow-sm transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="flex items-start mb-3">
                                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-100 text-blue-600 mr-3">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div>
                                    <h4 class="text-md font-bold text-gray-900">{{ $job->nama_job }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <i class="fas fa-clock text-gray-400 mr-1"></i> {{ $job->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 line-clamp-3 mt-1">{{ $job->deskripsi ?: 'No job description provided.' }}</p>
                            <div class="mt-3 pt-3 border-t border-gray-200 text-right">
                                <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 transition-colors">
                                    View Details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
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
                                        No jobs available for this period.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center gap-4 pt-4">
            <a href="{{ route('periode.edit', $periode) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                <i class="fas fa-edit mr-2"></i> Edit Period
            </a>
            <form action="{{ route('periode.destroy', $periode) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md" onclick="return confirm('Are you sure you want to delete this period?')">
                    <i class="fas fa-trash mr-2"></i> Delete Period
                </button>
            </form>
            <a href="{{ route('periode.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </div>
</x-crud-layout>
