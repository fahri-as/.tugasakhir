<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Criteria') }}
            </h2>
            <a href="{{ route('criteria.index', ['job_id' => $criterion->job_id]) }}" class="inline-block px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('criteria.update', $criterion->criteria_id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Selection -->
                            <div>
                                <x-input-label for="job_id" :value="__('Job Position')" />
                                <select id="job_id" name="job_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">Select a job position</option>
                                    @foreach($jobs as $job)
                                        <option value="{{ $job->job_id }}" {{ (old('job_id', $criterion->job_id) == $job->job_id) ? 'selected' : '' }}>
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
                                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code', $criterion->code)" required />
                                <p class="mt-1 text-xs text-gray-500">Short code for the criteria (e.g., SKILL, EDU)</p>
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Criteria Name -->
                        <div>
                            <x-input-label for="name" :value="__('Criteria Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $criterion->name)" required />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $criterion->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Weight -->
                        <div>
                            <x-input-label for="weight" :value="__('Weight')" />
                            <x-text-input id="weight" class="block mt-1 w-full" type="number" name="weight" :value="old('weight', $criterion->weight)" step="0.01" min="0" max="1" />
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

                    <!-- Rating Scales Section -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Rating Scales</h3>
                            <a href="{{ route('criteria-rating-scales.create', ['criteria_id' => $criterion->criteria_id]) }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Add Rating Scale') }}
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($criterion->criteriaRatingScales as $ratingScale)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $ratingScale->rating_level }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $ratingScale->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $ratingScale->description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('criteria-rating-scales.edit', $ratingScale) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                <form method="POST" action="{{ route('criteria-rating-scales.destroy', $ratingScale) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this rating scale?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                No rating scales found. Click "Add Rating Scale" to create one.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
