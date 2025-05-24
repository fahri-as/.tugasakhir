<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-star-half-alt text-amber-600 mr-2"></i> {{ __('Edit Capability Test Rating Scale') }}
            </h2>
            <a href="{{ route('jobs.show', $ratingScale->criteria->job_id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> Back to Job
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-amber-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-edit text-amber-600 mr-2"></i> Edit Rating Scale for "{{ $ratingScale->criteria->name }}"
                    </h3>
                </div>

                <div class="p-6">
                    <!-- Criteria Info Card -->
                    <div class="mb-6 bg-gradient-to-r from-amber-50 to-orange-50 rounded-lg p-4 border border-amber-100 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-amber-100 text-amber-600">
                                    <i class="fas fa-tasks"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-md font-medium text-amber-900">Capability Test Criteria</h3>
                                <div class="mt-1 flex items-center">
                                    <span class="bg-amber-100 text-amber-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">
                                        {{ $ratingScale->criteria->code }}
                                    </span>
                                    <span class="font-medium text-gray-900">{{ $ratingScale->criteria->name }}</span>
                                </div>
                                <p class="mt-1 text-sm text-amber-700">
                                    {{ Str::limit($ratingScale->criteria->description, 100) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('tes-kemampuan-rating-scales.update', $ratingScale->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Rating Level -->
                            <div>
                                <label for="rating_level" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-layer-group text-gray-500 mr-1"></i> Rating Level
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-sort-numeric-up text-gray-400"></i>
                                    </div>
                                    <input id="rating_level" name="rating_level" type="number"
                                        class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('rating_level') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                        min="1" max="5" value="{{ old('rating_level', $ratingScale->rating_level) }}" required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Enter a number between 1 and 5 (1 = Lowest, 5 = Highest)</p>
                                <x-input-error :messages="$errors->get('rating_level')" class="mt-2" />
                            </div>

                            <!-- Rating Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-tag text-gray-500 mr-1"></i> Name
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-font text-gray-400"></i>
                                    </div>
                                    <input id="name" name="name" type="text"
                                        class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                        placeholder="e.g., Excellent, Good, Average, Fair, Poor" value="{{ old('name', $ratingScale->name) }}" required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Enter a descriptive name for this rating level</p>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Score Range -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Min Score -->
                            <div>
                                <label for="min_score" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-arrow-down text-gray-500 mr-1"></i> Minimum Score
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tachometer-alt text-gray-400"></i>
                                    </div>
                                    <input id="min_score" name="min_score" type="number"
                                        class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('min_score') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                        min="0" max="100" value="{{ old('min_score', $ratingScale->min_score) }}" required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Enter the minimum score for this rating (0-100)</p>
                                <x-input-error :messages="$errors->get('min_score')" class="mt-2" />
                            </div>

                            <!-- Max Score -->
                            <div>
                                <label for="max_score" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-arrow-up text-gray-500 mr-1"></i> Maximum Score
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tachometer-alt text-gray-400"></i>
                                    </div>
                                    <input id="max_score" name="max_score" type="number"
                                        class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('max_score') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                        min="0" max="100" value="{{ old('max_score', $ratingScale->max_score) }}" required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Enter the maximum score for this rating (0-100)</p>
                                <x-input-error :messages="$errors->get('max_score')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="fas fa-align-left text-gray-500 mr-1"></i> Description
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="Provide detailed explanation of what this rating level means" required>{{ old('description', $ratingScale->description) }}</textarea>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Provide a detailed description of what this rating level means</p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex justify-end items-center gap-4">
                                <a href="{{ route('jobs.show', $ratingScale->criteria->job_id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-amber-600 hover:to-orange-700 active:bg-amber-900 focus:outline-none focus:border-amber-900 focus:ring focus:ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Update Rating Scale
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Delete Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center mb-4">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i> Danger Zone
                        </h3>

                        <form action="{{ route('tes-kemampuan-rating-scales.destroy', $ratingScale->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this rating scale? This action cannot be undone.');" class="mb-4">
                            @csrf
                            @method('DELETE')

                            <div class="bg-red-50 p-5 rounded-lg border border-red-200 shadow-sm flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="rounded-full h-10 w-10 flex items-center justify-center bg-red-100 text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-medium text-red-800">Delete this rating scale</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>Once you delete a rating scale, there is no going back. Please be certain.</p>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                            <i class="fas fa-trash mr-2"></i> Delete Rating Scale
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
