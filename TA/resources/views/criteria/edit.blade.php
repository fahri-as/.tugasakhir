<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Criteria') }}
            </h2>
            <a href="{{ route('criteria.index', ['job_id' => $criterium->job_id]) }}" class="inline-block px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('criteria.update', $criterium->criteria_id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Selection -->
                            <div>
                                <x-input-label for="job_id" :value="__('Job Position')" />
                                <select id="job_id" name="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select a job position</option>
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->job_id }}" {{ (old('job_id', $criterium->job_id) == $job->job_id) ? 'selected' : '' }}>
                                            {{ $job->nama_job }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('job_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Criteria Code -->
                            <div>
                                <x-input-label for="code" :value="__('Criteria Code')" />
                                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code', $criterium->code)" required />
                                <p class="mt-1 text-xs text-gray-500">Short code for the criteria (e.g., SKILL, EDU)</p>
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Criteria Name -->
                        <div>
                            <x-input-label for="name" :value="__('Criteria Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $criterium->name)" required />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $criterium->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Weight -->
                        <div>
                            <x-input-label for="weight" :value="__('Weight')" />
                            <x-text-input id="weight" class="block mt-1 w-full" type="number" name="weight" :value="old('weight', $criterium->weight)" step="0.01" min="0" max="1" />
                            <p class="mt-1 text-xs text-gray-500">Weight value between 0 and 1 (e.g., 0.25 represents 25% importance)</p>
                            @error('weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-3">
                                {{ __('Update Criteria') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
