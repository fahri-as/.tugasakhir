<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-edit text-indigo-600 mr-2"></i> {{ __('Edit Criteria') }}
            </h2>
            <a href="{{ route('criteria.index', ['job_id' => $criterion->job_id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list-check text-indigo-600 mr-2"></i> Edit Criteria: <span class="font-bold ml-2">{{ $criterion->name }} ({{ $criterion->code }})</span>
                    </h3>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('criteria.update', $criterion->criteria_id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Job Selection -->
                            <div>
                                <label for="job_id" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-briefcase text-gray-500 mr-1"></i> Job Position
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-building text-gray-400"></i>
                                    </div>
                                    <select id="job_id" name="job_id" class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('job_id') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" required>
                                        <option value="">Select a job position</option>
                                        @foreach($jobs as $job)
                                            <option value="{{ $job->job_id }}" {{ (old('job_id', $criterion->job_id) == $job->job_id) ? 'selected' : '' }}>
                                                {{ $job->nama_job }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('job_id')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Criteria Code -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-hashtag text-gray-500 mr-1"></i> Criteria Code
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-code text-gray-400"></i>
                                    </div>
                                    <input type="text" name="code" id="code" value="{{ old('code', $criterion->code) }}" required
                                        class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('code') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Short code for the criteria (e.g., SKILL, EDU)</p>
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Criteria Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="fas fa-tag text-gray-500 mr-1"></i> Criteria Name
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-font text-gray-400"></i>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $criterion->name) }}" required
                                    class="pl-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="fas fa-align-left text-gray-500 mr-1"></i> Description
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="Detailed explanation of what this criteria measures">{{ old('description', $criterion->description) }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex justify-end items-center gap-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                                    <i class="fas fa-save mr-2"></i> Update Criteria
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
                            <a href="{{ route('criteria-rating-scales.create', ['criteria_id' => $criterion->criteria_id]) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-sm">
                                <i class="fas fa-plus mr-2"></i> {{ __('Add Rating Scale') }}
                            </a>
                        </div>

                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-layer-group text-gray-400 mr-2"></i> Level
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-tag text-gray-400 mr-2"></i> Name
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center">
                                                <i class="fas fa-align-left text-gray-400 mr-2"></i> Description
                                            </span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span class="flex items-center justify-end">
                                                <i class="fas fa-cog text-gray-400 mr-2"></i> Actions
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($criterion->criteriaRatingScales as $ratingScale)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1.5 rounded">
                                                    Level {{ $ratingScale->rating_level }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                {{ $ratingScale->name }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $ratingScale->description }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex space-x-3 justify-end">
                                                    <a href="{{ route('criteria-rating-scales.edit', $ratingScale) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('criteria-rating-scales.destroy', $ratingScale) }}" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete" onclick="return confirm('Are you sure you want to delete this rating scale?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center">
                                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md inline-block text-left">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0">
                                                            <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-sm text-yellow-700">
                                                                No rating scales found. Click "Add Rating Scale" to create one.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($criterion->criteriaRatingScales->count() > 0)
                            <div class="mt-4 bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-md border border-blue-100 shadow-sm">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-info-circle text-blue-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            These rating scales will be used to evaluate applicants based on this criteria.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
