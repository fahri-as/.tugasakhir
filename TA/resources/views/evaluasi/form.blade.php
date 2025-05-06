<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($evaluation) ? __('Edit Evaluation') : __('New Evaluation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ isset($evaluation) ? route('evaluasi.update', $evaluation) : route('evaluasi.store') }}"
                      onsubmit="return validateForm(this)">
                    @csrf
                    @if(isset($evaluation))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <x-label for="intern_id" value="Intern" />
                        <select id="intern_id" name="intern_id" class="form-input" required>
                            <option value="">Select Intern</option>
                            @foreach($interns as $intern)
                                <option value="{{ $intern->id }}" {{ (isset($evaluation) && $evaluation->intern_id == $intern->id) ? 'selected' : '' }}>
                                    {{ $intern->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('intern_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <x-label for="period_id" value="Evaluation Period" />
                        <select id="period_id" name="period_id" class="form-input" required>
                            <option value="">Select Period</option>
                            @foreach($periods as $period)
                                <option value="{{ $period->id }}" {{ (isset($evaluation) && $evaluation->period_id == $period->id) ? 'selected' : '' }}>
                                    {{ $period->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('period_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <x-label for="score" value="Score" />
                        <x-input id="score" type="number" name="score" class="form-input"
                                value="{{ isset($evaluation) ? $evaluation->score : old('score') }}"
                                min="0" max="100" required />
                        @error('score')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <x-label for="comments" value="Comments" />
                        <textarea id="comments" name="comments" class="form-input" rows="4">{{ isset($evaluation) ? $evaluation->comments : old('comments') }}</textarea>
                        @error('comments')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button type="button" variant="secondary" href="{{ route('evaluasi.index') }}" class="mr-4">
                            {{ __('Cancel') }}
                        </x-button>
                        <x-button type="submit">
                            {{ isset($evaluation) ? __('Update Evaluation') : __('Create Evaluation') }}
                        </x-button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
