@extends('layouts.app')

@section('title', 'Weekly Total Scores for ' . $magang->pelamar->nama)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h3>Weekly Total Scores for {{ $magang->pelamar->nama }}</h3>
            <p>Position: {{ $magang->pelamar->job->nama_job ?? 'Unknown' }}</p>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('magang.show', $magang->magang_id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Intern Details
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Weekly Total Scores Summary</h5>
        </div>
        <div class="card-body">
            @if(!empty($weeklyTotalScores))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Week</th>
                                <th>Total Score</th>
                                <th>Visualization</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($weeklyTotalScores as $week => $score)
                                <tr>
                                    <td>Week {{ $week }}</td>
                                    <td>{{ number_format($score, 2) }}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ ($score/5)*100 }}%;"
                                                aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="5">
                                                {{ number_format($score, 2) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <canvas id="weeklyScoresChart" width="400" height="200"></canvas>
                </div>
            @else
                <div class="alert alert-info">
                    No weekly scores are available for this intern.
                </div>
            @endif
        </div>
    </div>
</div>

@if(!empty($weeklyTotalScores))
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('weeklyScoresChart').getContext('2d');

        // Prepare data for chart
        const weeks = [];
        const scores = [];

        @foreach($weeklyTotalScores as $week => $score)
            weeks.push('Week {{ $week }}');
            scores.push({{ $score }});
        @endforeach

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: weeks,
                datasets: [{
                    label: 'Weekly Total Score',
                    data: scores,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5,
                        title: {
                            display: true,
                            text: 'Score'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Week'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Weekly Progress',
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endpush
@endif

@endsection
