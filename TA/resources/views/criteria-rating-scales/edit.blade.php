<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Rating Scale') }}
            </h2>
            <a href="{{ route('criteria.show', $ratingScale->criteria_id) }}" class="inline-block px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150">
                Back to Criteria
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('criteria-rating-scales.update', $ratingScale->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="criteria_id" value="{{ $ratingScale->criteria_id }}">

                        <div>
                            <x-input-label for="criteria" :value="__('Criteria')" />
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $criteria->name }} ({{ $criteria->code }})
                            </p>
                        </div>

                        <div>
                            <x-input-label for="rating_level" :value="__('Rating Level')" />
                            <x-text-input id="rating_level" name="rating_level" type="number" class="mt-1 block w-full"
                                :value="old('rating_level', $ratingScale->rating_level)" min="1" max="5" required />
                            <p class="mt-1 text-xs text-gray-500">Enter a number between 1 and 5</p>
                            <x-input-error :messages="$errors->get('rating_level')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $ratingScale->name)" required />
                            <p class="mt-1 text-xs text-gray-500">Enter a descriptive name for this rating level</p>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                rows="4" required>{{ old('description', $ratingScale->description) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Provide a detailed description of what this rating level means</p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Rating Scale') }}</x-primary-button>
                            <a href="{{ route('criteria.show', $ratingScale->criteria_id) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
