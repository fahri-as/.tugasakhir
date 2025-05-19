<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Criteria') }}
            </h2>
            @if(isset($selectedJobId))
                <a href="{{ route('criteria.index', ['job_id' => $selectedJobId]) }}" class="inline-block px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150">
                    Back to List
                </a>
            @else
                <a href="{{ route('criteria.index') }}" class="inline-block px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150">
                    Back to List
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('criteria.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Selection -->
                            <div>
                                <x-input-label for="job_id" :value="__('Job Position')" />
                                <select id="job_id" name="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select a job position</option>
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->job_id }}" {{ (old('job_id', $selectedJobId) == $job->job_id) ? 'selected' : '' }}>
                                            {{ $job->nama_job }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Select the job position this criteria applies to</p>
                                @error('job_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Criteria Code -->
                            <div>
                                <x-input-label for="code" :value="__('Criteria Code')" />
                                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus />
                                <p class="mt-1 text-xs text-gray-500">Short code for the criteria (e.g., K1, K2, K3)</p>
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Criteria Name -->
                        <div>
                            <x-input-label for="name" :value="__('Criteria Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                            <p class="mt-1 text-xs text-gray-500">Full name of the criteria (e.g., Cooking Skills, Teamwork)</p>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Detailed explanation of what this criteria measures</p>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('criteria.index', isset($selectedJobId) ? ['job_id' => $selectedJobId] : []) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 mr-3">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Create Criteria') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Rating Scales Section -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Rating Scales</h3>
                            <p class="text-sm text-gray-500">Add rating scales after creating the criteria</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500 text-center">
                                Rating scales can be added after the criteria is created. You will be redirected to the criteria details page where you can manage rating scales.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
