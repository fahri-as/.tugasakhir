<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-star-half-alt text-indigo-600 mr-2"></i> {{ __('Rating Scale Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('criteria-rating-scales.edit', $ratingScale) }}"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                    <i class="fas fa-edit mr-2"></i> {{ __('Edit') }}
                </a>
                <form method="POST" action="{{ route('criteria-rating-scales.destroy', $ratingScale) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-red-600 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow hover:shadow-md"
                        onclick="return confirm('Are you sure you want to delete this rating scale?')">
                        <i class="fas fa-trash mr-2"></i> {{ __('Delete') }}
                    </button>
                </form>
                <a href="{{ route('criteria.show', $ratingScale->criteria_id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Criteria
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-info-circle text-indigo-600 mr-2"></i> Rating Scale Information
                    </h3>
                </div>

                <div class="p-6">
                    <!-- Parent Criteria Info -->
                    <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-100 shadow-sm">
                        <h3 class="text-md font-medium text-blue-900 flex items-center mb-2">
                            <i class="fas fa-list-check text-blue-600 mr-2"></i> Parent Criteria
                        </h3>
                        <div class="flex items-center">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-1.5 rounded">
                                {{ $ratingScale->criteria->code }}
                            </span>
                            <span class="font-medium text-gray-900">{{ $ratingScale->criteria->name }}</span>
                            <a href="{{ route('criteria.show', $ratingScale->criteria_id) }}" class="ml-auto text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                <span class="text-xs">View Criteria</span>
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Rating Scale Details Card -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-3 bg-gradient-to-r from-amber-50 to-amber-100 border-b border-gray-200">
                            <h4 class="text-md font-semibold text-amber-900 flex items-center">
                                <i class="fas fa-star-half-alt text-amber-600 mr-2"></i> Rating Scale
                            </h4>
                        </div>

                        <div class="p-6">
                            <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                                <!-- Rating Level -->
                                <div class="bg-gradient-to-r from-amber-50 to-yellow-50 p-4 rounded-lg border border-amber-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                    <dt class="text-sm font-medium text-amber-900 flex items-center">
                                        <i class="fas fa-layer-group text-amber-500 mr-2"></i> Rating Level
                                    </dt>
                                    <dd class="mt-2 flex items-center">
                                        <span class="bg-amber-100 text-amber-800 text-sm font-medium px-3 py-1.5 rounded-full">
                                            Level {{ $ratingScale->rating_level }}
                                        </span>
                                    </dd>
                                </div>

                                <!-- Name -->
                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-lg border border-green-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                    <dt class="text-sm font-medium text-green-900 flex items-center">
                                        <i class="fas fa-tag text-green-500 mr-2"></i> Name
                                    </dt>
                                    <dd class="mt-2 text-base font-semibold text-gray-900">{{ $ratingScale->name }}</dd>
                                </div>

                                <!-- Description -->
                                <div class="col-span-full bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-lg border border-gray-200 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                    <dt class="text-sm font-medium text-gray-900 flex items-center">
                                        <i class="fas fa-align-left text-gray-500 mr-2"></i> Description
                                    </dt>
                                    <dd class="mt-2 text-base text-gray-900 whitespace-pre-line">{{ $ratingScale->description }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Rating Guide -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center mb-4">
                            <i class="fas fa-info-circle text-indigo-600 mr-2"></i> Rating Level Interpretation
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <!-- Poor -->
                            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm {{ $ratingScale->rating_level == 1 ? 'ring-2 ring-amber-500' : '' }}">
                                <div class="text-center mb-2">
                                    <span class="inline-block w-8 h-8 rounded-full bg-red-100 text-red-800 flex items-center justify-center font-bold">1</span>
                                </div>
                                <h4 class="font-medium text-center {{ $ratingScale->rating_level == 1 ? 'text-amber-600' : 'text-gray-900' }}">Poor</h4>
                                <p class="mt-2 text-xs text-gray-600 text-center">Far below expected standards</p>
                            </div>

                            <!-- Fair -->
                            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm {{ $ratingScale->rating_level == 2 ? 'ring-2 ring-amber-500' : '' }}">
                                <div class="text-center mb-2">
                                    <span class="inline-block w-8 h-8 rounded-full bg-orange-100 text-orange-800 flex items-center justify-center font-bold">2</span>
                                </div>
                                <h4 class="font-medium text-center {{ $ratingScale->rating_level == 2 ? 'text-amber-600' : 'text-gray-900' }}">Fair</h4>
                                <p class="mt-2 text-xs text-gray-600 text-center">Below expected standards</p>
                            </div>

                            <!-- Average -->
                            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm {{ $ratingScale->rating_level == 3 ? 'ring-2 ring-amber-500' : '' }}">
                                <div class="text-center mb-2">
                                    <span class="inline-block w-8 h-8 rounded-full bg-yellow-100 text-yellow-800 flex items-center justify-center font-bold">3</span>
                                </div>
                                <h4 class="font-medium text-center {{ $ratingScale->rating_level == 3 ? 'text-amber-600' : 'text-gray-900' }}">Average</h4>
                                <p class="mt-2 text-xs text-gray-600 text-center">Meets expected standards</p>
                            </div>

                            <!-- Good -->
                            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm {{ $ratingScale->rating_level == 4 ? 'ring-2 ring-amber-500' : '' }}">
                                <div class="text-center mb-2">
                                    <span class="inline-block w-8 h-8 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-bold">4</span>
                                </div>
                                <h4 class="font-medium text-center {{ $ratingScale->rating_level == 4 ? 'text-amber-600' : 'text-gray-900' }}">Good</h4>
                                <p class="mt-2 text-xs text-gray-600 text-center">Above expected standards</p>
                            </div>

                            <!-- Excellent -->
                            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm {{ $ratingScale->rating_level == 5 ? 'ring-2 ring-amber-500' : '' }}">
                                <div class="text-center mb-2">
                                    <span class="inline-block w-8 h-8 rounded-full bg-green-100 text-green-800 flex items-center justify-center font-bold">5</span>
                                </div>
                                <h4 class="font-medium text-center {{ $ratingScale->rating_level == 5 ? 'text-amber-600' : 'text-gray-900' }}">Excellent</h4>
                                <p class="mt-2 text-xs text-gray-600 text-center">Far exceeds expected standards</p>
                            </div>
                        </div>

                        <div class="mt-4 bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-md border border-blue-100 shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        This rating scale is used to evaluate applicants on the <span class="font-semibold">{{ $ratingScale->criteria->name }}</span> criteria.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('criteria-rating-scales.edit', $ratingScale) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                            <i class="fas fa-edit mr-2"></i> Edit Rating Scale
                        </a>
                        <a href="{{ route('criteria.show', $ratingScale->criteria_id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Criteria
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
