<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-star-half-alt text-teal-600 mr-2"></i> {{ __('Create Interview Rating Scale') }}
            </h2>
            <a href="{{ route('jobs.show', $criteria->job_id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> Back to Job
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-teal-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-plus-circle text-teal-600 mr-2"></i> Add New Rating Scale for "{{ $criteria->name }}"
                    </h3>
                </div>

                <div class="p-6">
                    <!-- Criteria Info Card -->
                    <div class="mb-6 bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg p-4 border border-teal-100 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-teal-100 text-teal-600">
                                    <i class="fas fa-comments"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-md font-medium text-teal-900">Selected Interview Criteria</h3>
                                <div class="mt-1 flex items-center">
                                    <span class="bg-teal-100 text-teal-800 text-xs font-medium mr-2 px-2.5 py-1 rounded">
                                        {{ $criteria->code }}
                                    </span>
                                    <span class="font-medium text-gray-900">{{ $criteria->name }}</span>
                                </div>
                                <p class="mt-1 text-sm text-teal-700">
                                    {{ Str::limit($criteria->description, 100) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('interview-rating-scales.store') }}" class="space-y-6">
                        @csrf

                        <input type="hidden" name="criteria_id" value="{{ $criteria->criteria_id }}">

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
                                        class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('rating_level') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                        min="1" max="5" value="{{ old('rating_level') }}" required>
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
                                        class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                        placeholder="e.g., Excellent, Good, Average, Fair, Poor" value="{{ old('name') }}" required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Enter a descriptive name for this rating level</p>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="fas fa-align-left text-gray-500 mr-1"></i> Description
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="Provide detailed explanation of what this rating level means" required>{{ old('description') }}</textarea>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Provide a detailed description of what this rating level means</p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex justify-end items-center gap-4">
                                <a href="{{ route('jobs.show', $criteria->job_id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                                    <i class="fas fa-times mr-2"></i> Cancel
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-cyan-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-teal-600 hover:to-cyan-700 active:bg-teal-900 focus:outline-none focus:border-teal-900 focus:ring focus:ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Create Rating Scale
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Rating Guidelines -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center mb-4">
                            <i class="fas fa-info-circle text-teal-600 mr-2"></i> Rating Scale Guidelines
                        </h3>

                        <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg p-4 border border-teal-100 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                                <div class="bg-white p-3 rounded shadow-sm border border-teal-200">
                                    <div class="font-medium text-teal-800 flex items-center mb-1">
                                        <span class="bg-teal-100 text-teal-800 text-xs px-1.5 py-0.5 rounded mr-1">1</span>
                                        <span>Poor</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Far below expected standards</p>
                                </div>
                                <div class="bg-white p-3 rounded shadow-sm border border-teal-200">
                                    <div class="font-medium text-teal-800 flex items-center mb-1">
                                        <span class="bg-teal-100 text-teal-800 text-xs px-1.5 py-0.5 rounded mr-1">2</span>
                                        <span>Fair</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Below expected standards</p>
                                </div>
                                <div class="bg-white p-3 rounded shadow-sm border border-teal-200">
                                    <div class="font-medium text-teal-800 flex items-center mb-1">
                                        <span class="bg-teal-100 text-teal-800 text-xs px-1.5 py-0.5 rounded mr-1">3</span>
                                        <span>Average</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Meets expected standards</p>
                                </div>
                                <div class="bg-white p-3 rounded shadow-sm border border-teal-200">
                                    <div class="font-medium text-teal-800 flex items-center mb-1">
                                        <span class="bg-teal-100 text-teal-800 text-xs px-1.5 py-0.5 rounded mr-1">4</span>
                                        <span>Good</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Above expected standards</p>
                                </div>
                                <div class="bg-white p-3 rounded shadow-sm border border-teal-200">
                                    <div class="font-medium text-teal-800 flex items-center mb-1">
                                        <span class="bg-teal-100 text-teal-800 text-xs px-1.5 py-0.5 rounded mr-1">5</span>
                                        <span>Excellent</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Far exceeds expected standards</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
