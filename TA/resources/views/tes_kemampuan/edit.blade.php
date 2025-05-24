<!-- ... existing code ... -->

<div class="form-group row">
    <label for="criteria_id" class="col-md-2 col-form-label">Kriteria</label>
    <div class="col-md-10">
        <select id="criteria_id" name="criteria_id" class="form-control @error('criteria_id') is-invalid @enderror" required>
            <option value="">Pilih Kriteria</option>
            @foreach($criteria as $criterion)
                <option value="{{ $criterion->criteria_id }}" {{ old('criteria_id', $tesKemampuan->criteria_id) == $criterion->criteria_id ? 'selected' : '' }}>
                    {{ $criterion->name }} - {{ $criterion->description }}
                </option>
            @endforeach
        </select>
        @error('criteria_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="skor" class="col-md-2 col-form-label">Skor (0-100)</label>
    <div class="col-md-10">
        <input type="number" min="0" max="100" step="1" class="form-control @error('skor') is-invalid @enderror" id="skor" name="skor" value="{{ old('skor', $tesKemampuan->skor) }}" required>

        @if(isset($ratingScales) && count($ratingScales) > 0)
            <div class="mt-2">
                <div id="score_rating" class="text-info">
                    @php
                        $currentRating = null;
                        foreach($ratingScales as $rating) {
                            if ($tesKemampuan->skor >= $rating->min_score && $tesKemampuan->skor <= $rating->max_score) {
                                $currentRating = $rating;
                                break;
                            }
                        }
                    @endphp

                    @if($currentRating)
                        Level {{ $currentRating->rating_level }} - {{ $currentRating->name }}: {{ $currentRating->description }}
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <h6>Rating Scale:</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Nama</th>
                                <th>Range Skor</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ratingScales as $rating)
                                <tr>
                                    <td>{{ $rating->rating_level }}</td>
                                    <td>{{ $rating->name }}</td>
                                    <td>{{ $rating->min_score }} - {{ $rating->max_score }}</td>
                                    <td>{{ $rating->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @error('skor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- ... existing code ... -->

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Handle pelamar selection
        $('#pelamar_id').change(function() {
            // Get the selected pelamar
            var pelamarId = $(this).val();
            if (pelamarId) {
                // Redirect to edit page with the new pelamar
                window.location.href = "{{ route('tes_kemampuan.edit', $tesKemampuan->tes_kemampuan_id) }}?pelamar_id=" + pelamarId;
            }
        });

        // Handle criteria selection
        $('#criteria_id').change(function() {
            // Get the selected criteria
            var criteriaId = $(this).val();
            if (criteriaId) {
                // Redirect to edit page with the new criteria
                window.location.href = "{{ route('tes_kemampuan.edit', $tesKemampuan->tes_kemampuan_id) }}?criteria_id=" + criteriaId;
            }
        });

        // Handle score changes
        $('#skor').on('input', function() {
            var score = $(this).val();
            var ratingHtml = '';

            @if(isset($ratingScales) && count($ratingScales) > 0)
                @foreach($ratingScales as $rating)
                    if (score >= {{ $rating->min_score }} && score <= {{ $rating->max_score }}) {
                        ratingHtml = 'Level {{ $rating->rating_level }} - {{ $rating->name }}: {{ $rating->description }}';
                    }
                @endforeach
            @endif

            $('#score_rating').html(ratingHtml);
        });
    });
</script>
@endsection

<!-- ... existing code ... -->
