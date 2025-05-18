<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Criteria Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('criteria.edit', $criterium->criteria_id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit Criteria
                </a>
                <a href="{{ route('criteria.index', ['job_id' => $criterium->job_id]) }}" class="inline-block px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- ID & Code -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Criteria ID</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $criterium->criteria_id }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Code</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $criterium->code }}</p>
                            </div>

                            <!-- Name & Weight -->
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $criterium->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Weight</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $criterium->weight }} ({{ number_format($criterium->weight * 100, 0) }}%)</p>
                            </div>

                            <!-- Job -->
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Job Position</p>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $criterium->job->nama_job }}
                                    <a href="{{ route('criteria.index', ['job_id' => $criterium->job_id]) }}" class="ml-2 text-indigo-600 hover:text-indigo-900">
                                        View All Criteria for this Job &rarr;
                                    </a>
                                </p>
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-500">Description</p>
                                <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $criterium->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Criteria Comparisons Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Comparisons</h3>

                        @if($criterium->rowComparisons->count() > 0 || $criterium->columnComparisons->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria A</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comparison</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria B</th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($criterium->rowComparisons as $comparison)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $criterium->name }} ({{ $criterium->code }})
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">compared to</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $comparison->criteriaColumn->name }} ({{ $comparison->criteriaColumn->code }})
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $comparison->value }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        @foreach($criterium->columnComparisons as $comparison)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $comparison->criteriaRow->name }} ({{ $comparison->criteriaRow->code }})
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">compared to</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $criterium->name }} ({{ $criterium->code }})
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $comparison->value }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 bg-gray-50 rounded">
                                <p class="text-gray-500">No comparisons found for this criteria.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Delete Criteria Form -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Danger Zone</h3>

                        <form action="{{ route('criteria.destroy', $criterium->criteria_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this criteria? This action cannot be undone.');" class="mb-4">
                            @csrf
                            @method('DELETE')

                            <div class="bg-red-50 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Delete this criteria</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>Once you delete a criteria, there is no going back. This will permanently remove the criteria and all related data.</p>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Delete Criteria
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Force Delete Form -->
                        <form action="{{ route('criteria.force-destroy', $criterium->criteria_id) }}" method="POST" onsubmit="return confirm('WARNING: This will force delete the criteria and remove all associated comparisons and evaluations. This action CANNOT BE UNDONE. Are you absolutely sure?');">
                            @csrf
                            @method('DELETE')

                            <div class="bg-red-100 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-900">Force Delete this criteria</h3>
                                        <div class="mt-2 text-sm text-red-800">
                                            <p>USE WITH CAUTION! This will remove the criteria and ALL associated comparisons and evaluations that reference it.</p>
                                            <p class="mt-1">This is useful when you're getting deletion errors, but it may affect data integrity. Only use if you understand the consequences.</p>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Force Delete Criteria
                                            </button>
                                        </div>
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
