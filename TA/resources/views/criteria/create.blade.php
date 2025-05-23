<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-plus-circle text-indigo-600 mr-2"></i> {{ __('Add New Criteria') }}
            </h2>
            @if(isset($selectedJobId))
                <a href="{{ route('criteria.index', ['job_id' => $selectedJobId]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            @else
                <a href="{{ route('criteria.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list-check text-indigo-600 mr-2"></i> Create New Criteria
                    </h3>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('criteria.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Selection -->
                            <div>
                                <x-input-label for="job_id" :value="__('Job Position')" class="flex items-center">
                                    <i class="fas fa-briefcase text-gray-500 mr-1"></i> Job Position
                                </x-input-label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-building text-gray-400"></i>
                                    </div>
                                    <select id="job_id" name="job_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('job_id') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" required>
                                        <option value="">Select a job position</option>
                                        @foreach($jobs as $job)
                                            <option value="{{ $job->job_id }}" {{ (old('job_id', $selectedJobId) == $job->job_id) ? 'selected' : '' }}>
                                                {{ $job->nama_job }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Select the job position this criteria applies to</p>
                                @error('job_id')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Criteria Code -->
                            <div>
                                <x-input-label for="code" :value="__('Criteria Code')" class="flex items-center">
                                    <i class="fas fa-hashtag text-gray-500 mr-1"></i> Criteria Code
                                </x-input-label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-code text-gray-400"></i>
                                    </div>
                                    <input id="code" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('code') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" type="text" name="code" value="{{ old('code') }}" required autofocus placeholder="e.g., K1, SKILL, EDU" />
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Short code for the criteria (e.g., K1, K2, K3)</p>
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Criteria Name -->
                        <div>
                            <x-input-label for="name" :value="__('Criteria Name')" class="flex items-center">
                                <i class="fas fa-tag text-gray-500 mr-1"></i> Criteria Name
                            </x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-font text-gray-400"></i>
                                </div>
                                <input id="name" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" type="text" name="name" value="{{ old('name') }}" required placeholder="e.g., Cooking Skills, Teamwork" />
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Full name of the criteria (e.g., Cooking Skills, Teamwork)</p>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" class="flex items-center">
                                <i class="fas fa-align-left text-gray-500 mr-1"></i> Description
                            </x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Detailed explanation of what this criteria measures">{{ old('description') }}</textarea>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Detailed explanation of what this criteria measures</p>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex justify-end items-center gap-4">
                                <a href="{{ route('criteria.index', isset($selectedJobId) ? ['job_id' => $selectedJobId] : []) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Create Criteria
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Rating Scales Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-star-half-alt text-indigo-600 mr-2"></i> Rating Scales
                            </h3>
                            <span class="text-sm text-gray-500">Add rating scales after creating the criteria</span>
                        </div>

                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-lg p-5 border border-yellow-100 shadow-sm">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-amber-500 text-lg mt-0.5"></i>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-amber-800">Rating scales will be added later</h4>
                                    <p class="mt-2 text-sm text-amber-700">
                                        After creating this criteria, you'll be able to add rating scales on the criteria details page. These scales help evaluate applicants based on this criteria.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
