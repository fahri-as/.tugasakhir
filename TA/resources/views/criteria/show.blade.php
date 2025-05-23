<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-list-check text-indigo-600 mr-2"></i> {{ __('Criteria Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('criteria.edit', $criterion->criteria_id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                    <i class="fas fa-edit mr-2"></i> Edit Criteria
                </a>
                <a href="{{ route('criteria.index', ['job_id' => $criterion->job_id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-info-circle text-indigo-600 mr-2"></i> Basic Information
                        </h3>
                    </div>

                    <div class="p-6 bg-white">
                        <dl class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <dt class="text-sm font-medium text-blue-900 flex items-center">
                                    <i class="fas fa-id-card text-blue-500 mr-2"></i> Criteria ID
                                </dt>
                                <dd class="mt-2 text-base font-semibold text-gray-900">{{ $criterion->criteria_id }}</dd>
                            </div>

                            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <dt class="text-sm font-medium text-indigo-900 flex items-center">
                                    <i class="fas fa-hashtag text-indigo-500 mr-2"></i> Code
                                </dt>
                                <dd class="mt-2 text-base font-semibold text-gray-900">{{ $criterion->code }}</dd>
                            </div>

                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <dt class="text-sm font-medium text-purple-900 flex items-center">
                                    <i class="fas fa-tag text-purple-500 mr-2"></i> Name
                                </dt>
                                <dd class="mt-2 text-base font-semibold text-gray-900">{{ $criterion->name }}</dd>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg border border-green-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <dt class="text-sm font-medium text-green-900 flex items-center">
                                    <i class="fas fa-balance-scale text-green-500 mr-2"></i> Weight
                                </dt>
                                <dd class="mt-2 text-base font-semibold text-gray-900">{{ $criterion->weight }} ({{ number_format($criterion->weight * 100, 0) }}%)</dd>
                            </div>

                            <div class="sm:col-span-2 bg-amber-50 p-4 rounded-lg border border-amber-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <dt class="text-sm font-medium text-amber-900 flex items-center">
                                    <i class="fas fa-briefcase text-amber-500 mr-2"></i> Job Position
                                </dt>
                                <dd class="mt-2 flex items-center">
                                    <span class="text-base font-semibold text-gray-900">{{ $criterion->job->nama_job }}</span>
                                    <a href="{{ route('criteria.index', ['job_id' => $criterion->job_id]) }}" class="ml-3 text-indigo-600 hover:text-indigo-900 flex items-center">
                                        <span>View All Criteria for this Job</span>
                                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                </dd>
                            </div>

                            <div class="col-span-full bg-gray-50 p-4 rounded-lg border border-gray-200 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                <dt class="text-sm font-medium text-gray-900 flex items-center">
                                    <i class="fas fa-align-left text-gray-500 mr-2"></i> Description
                                </dt>
                                <dd class="mt-2 text-base text-gray-900 whitespace-pre-line">{{ $criterion->description ?: 'No description provided.' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Criteria Comparisons Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-balance-scale text-indigo-600 mr-2"></i> Criteria Comparisons
                        </h3>
                    </div>

                    <div class="p-6 bg-white">
                        @if($criterion->rowComparisons->count() > 0 || $criterion->columnComparisons->count() > 0)
                            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-cube text-gray-400 mr-2"></i> Criteria A
                                                </span>
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-exchange-alt text-gray-400 mr-2"></i> Comparison
                                                </span>
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-cube text-gray-400 mr-2"></i> Criteria B
                                                </span>
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gradient-to-r from-gray-50 to-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="flex items-center">
                                                    <i class="fas fa-sort-amount-up text-gray-400 mr-2"></i> Value
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criterion->rowComparisons as $comparison)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <span class="px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">
                                                        {{ $criterion->code }}
                                                    </span>
                                                    <span class="ml-2">{{ $criterion->name }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <i class="fas fa-arrow-right text-indigo-500"></i>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <span class="px-2.5 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded">
                                                        {{ $comparison->columnCriteria->code }}
                                                    </span>
                                                    <span class="ml-2">{{ $comparison->columnCriteria->name }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                    {{ $comparison->value }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        @foreach($criterion->columnComparisons as $comparison)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <span class="px-2.5 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">
                                                        {{ $comparison->rowCriteria->code }}
                                                    </span>
                                                    <span class="ml-2">{{ $comparison->rowCriteria->name }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <i class="fas fa-arrow-right text-indigo-500"></i>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <span class="px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">
                                                        {{ $criterion->code }}
                                                    </span>
                                                    <span class="ml-2">{{ $criterion->name }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                    {{ $comparison->value }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            No comparisons found for this criteria. Use the AHP section to create comparisons.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Rating Scales Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-indigo-50 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-star-half-alt text-indigo-600 mr-2"></i> Rating Scales
                            </h3>
                            <a href="{{ route('criteria-rating-scales.create', ['criteria_id' => $criterion->criteria_id]) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-sm">
                                <i class="fas fa-plus mr-2"></i> {{ __('Add Rating Scale') }}
                            </a>
                        </div>
                    </div>

                    <div class="p-6 bg-white">
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
                    </div>
                </div>

                <!-- Delete Criteria Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-red-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i> Danger Zone
                        </h3>
                    </div>

                    <div class="p-6 bg-white">
                        <div class="space-y-6">
                            <!-- Delete Normal -->
                            <form action="{{ route('criteria.destroy', $criterion->criteria_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this criteria? This action cannot be undone.');" class="mb-4">
                                @csrf
                                @method('DELETE')

                                <div class="bg-red-50 p-5 rounded-lg border border-red-200 shadow-sm flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-full h-10 w-10 flex items-center justify-center bg-red-100 text-red-500">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h3 class="text-lg font-medium text-red-800">Delete this criteria</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>Once you delete a criteria, there is no going back. This will remove the criteria but preserve associated comparisons.</p>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                <i class="fas fa-trash mr-2"></i> Delete Criteria
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Force Delete -->
                            <form action="{{ route('criteria.force-destroy', $criterion->criteria_id) }}" method="POST" onsubmit="return confirm('WARNING: This will force delete the criteria and remove all associated comparisons and evaluations. This action CANNOT BE UNDONE. Are you absolutely sure?');">
                                @csrf
                                @method('DELETE')

                                <div class="bg-red-100 p-5 rounded-lg border border-red-300 shadow-sm flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-full h-10 w-10 flex items-center justify-center bg-red-200 text-red-600">
                                            <i class="fas fa-bomb"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h3 class="text-lg font-medium text-red-900">Force Delete this criteria</h3>
                                        <div class="mt-2 text-sm text-red-800">
                                            <p class="font-semibold">USE WITH EXTREME CAUTION!</p>
                                            <p class="mt-1">This will permanently remove the criteria and ALL associated comparisons and evaluations that reference it.</p>
                                            <p class="mt-1">This operation is useful when you're getting deletion errors, but may severely affect data integrity. Only use if you understand the consequences.</p>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                <i class="fas fa-exclamation-triangle mr-2"></i> Force Delete Criteria
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('criteria.edit', $criterion->criteria_id) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-600 hover:to-purple-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow hover:shadow-md">
                        <i class="fas fa-edit mr-2"></i> Edit Criteria
                    </a>
                    <a href="{{ route('criteria.index', ['job_id' => $criterion->job_id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
