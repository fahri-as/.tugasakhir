<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Weekly Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('evaluasi.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <!-- Magang (Intern) Selection -->
                            <div>
                                <label for="magang_id" class="block text-sm font-medium text-gray-700">Intern</label>
                                <select id="magang_id" name="magang_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('magang_id') border-red-500 @enderror" required>
                                    <option value="">Select Intern</option>
                                    @foreach($magang as $intern)
                                        <option value="{{ $intern->magang_id }}" @if(old('magang_id') == $intern->magang_id) selected @endif>
                                            {{ $intern->pelamar->nama }} - {{ $intern->pelamar->job->nama_job ?? 'No Job' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('magang_id')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Criteria Selection -->
                            <div>
                                <label for="criteria_id" class="block text-sm font-medium text-gray-700">Criteria (Optional)</label>
                                <select id="criteria_id" name="criteria_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('criteria_id') border-red-500 @enderror">
                                    <option value="">No specific criteria</option>
                                    @foreach($criteria as $criteriaItem)
                                        <option value="{{ $criteriaItem->criteria_id }}" @if(old('criteria_id') == $criteriaItem->criteria_id) selected @endif>
                                            {{ $criteriaItem->name }} ({{ $criteriaItem->code }}) - {{ $criteriaItem->job->nama_job }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('criteria_id')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rating Selection -->
                            <div>
                                <label for="rating_id" class="block text-sm font-medium text-gray-700">Rating</label>
                                <select id="rating_id" name="rating_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('rating_id') border-red-500 @enderror">
                                    <option value="">Not Rated Yet</option>
                                    @foreach($ratingScales as $rating)
                                        <option value="{{ $rating->rating_id }}" @if(old('rating_id') == $rating->rating_id) selected @endif>
                                            {{ $rating->name }} ({{ $rating->singkatan }}) - Value: {{ $rating->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rating_id')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Week Number -->
                            <div>
                                <label for="minggu_ke" class="block text-sm font-medium text-gray-700">Week Number</label>
                                <input type="number" id="minggu_ke" name="minggu_ke" min="1" value="{{ old('minggu_ke', $selectedWeek ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('minggu_ke') border-red-500 @enderror" required>
                                @error('minggu_ke')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create Evaluation
                            </button>
                            <a href="{{ route('evaluasi.index', request()->has('periode_id') ? ['periode_id' => request('periode_id')] : []) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const magangSelect = document.getElementById('magang_id');
            const criteriaSelect = document.getElementById('criteria_id');

            // Function to filter criteria based on selected intern's job
            function filterCriteria() {
                // Get selected intern's option
                const selectedOption = magangSelect.options[magangSelect.selectedIndex];

                if (selectedOption && selectedOption.value) {
                    // Extract job ID from the text (assuming format: "Name - Job")
                    const text = selectedOption.text;
                    const jobPart = text.split('-')[1]?.trim();

                    if (jobPart) {
                        // Hide criteria that don't match the job
                        Array.from(criteriaSelect.options).forEach(option => {
                            if (option.value === '') return; // Skip "No specific criteria" option

                            const criteriaJob = option.text.split('-')[1]?.trim();

                            if (criteriaJob && criteriaJob !== jobPart) {
                                option.style.display = 'none';
                            } else {
                                option.style.display = '';
                            }
                        });
                    }
                }
            }

            // Filter criteria on load
            filterCriteria();

            // Filter criteria when intern selection changes
            magangSelect.addEventListener('change', filterCriteria);
        });
    </script>
</x-app-layout>
