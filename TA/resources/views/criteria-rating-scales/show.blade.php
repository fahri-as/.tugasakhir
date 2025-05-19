<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rating Scale Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('criteria-rating-scales.edit', $ratingScale) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <form method="POST" action="{{ route('criteria-rating-scales.destroy', $ratingScale) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        onclick="return confirm('Are you sure you want to delete this rating scale?')">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Criteria</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $ratingScale->criteria->name }} ({{ $ratingScale->criteria->code }})
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Rating Level</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $ratingScale->rating_level }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Name</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $ratingScale->name }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Description</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $ratingScale->description }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('criteria-rating-scales.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Back to List') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
