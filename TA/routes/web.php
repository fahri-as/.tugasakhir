<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\TesKemampuanController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\EvaluasiMingguanMagangController;
use App\Http\Controllers\AHPController;
use App\Http\Controllers\SMARTController;
use App\Http\Controllers\SMARTEvaluasiController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\CriteriaRatingScaleController;
use App\Http\Controllers\CriteriaComparisonController;
use App\Http\Controllers\ApplicantProgressController;
use Illuminate\Support\Facades\Route;
use App\Models\Periode;

Route::get('/', function () {
    $periodes = Periode::with('jobs')->get();
    return view('welcome', compact('periodes'));
});

// This route is accessible to everyone (public)
Route::post('/apply', [PelamarController::class, 'store'])->name('pelamar.public.store');

// Applicant Progress Tracking Routes (public)
Route::get('/track-progress', [ApplicantProgressController::class, 'index'])->name('applicant.progress.index');
Route::get('/track-progress/{periode_id}', [ApplicantProgressController::class, 'selectPeriod'])->name('applicant.progress.select-period');
Route::post('/track-progress/{periode_id}', [ApplicantProgressController::class, 'trackProgress'])->name('applicant.progress.track');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job routes
    Route::resource('jobs', JobController::class);
    Route::resource('job', JobController::class);

    // Periode routes
    Route::resource('periode', PeriodeController::class);

    // Pelamar routes - add all methods except store which has a public route
    Route::resource('pelamar', PelamarController::class)->except(['store']);
    Route::post('pelamar', [PelamarController::class, 'store'])->name('pelamar.store');

    // Interview routes
    Route::resource('interview', InterviewController::class);
    // Add the new simplified interview scheduling route
    Route::post('/interview/schedule', [InterviewController::class, 'schedule'])->name('interview.schedule');

    // Tes Kemampuan routes
    Route::resource('tes-kemampuan', TesKemampuanController::class);

    // Magang routes

    // Add SMART dashboard route for Magang (must be before resource route)
    Route::get('magang/smart-dashboard', [MagangController::class, 'smartDashboard'])
        ->name('magang.smartDashboard');

    // Add weekly total scores route (must be before resource route)
    Route::get('magang/{magang}/weekly-scores', [MagangController::class, 'weeklyTotalScores'])
        ->name('magang.weeklyScores');

    Route::resource('magang', MagangController::class);
    Route::patch('magang/{magang}/status', [MagangController::class, 'updateStatus'])
        ->name('magang.updateStatus');
    // Add the new route for scheduling internship start and creating evaluations
    Route::post('magang/schedule-start/{tesKemampuan}', [MagangController::class, 'scheduleStart'])
        ->name('magang.schedule-start');

    // Evaluasi Mingguan routes
    Route::resource('evaluasi', EvaluasiMingguanMagangController::class);

    // Add SMART dashboard route for Evaluasi
    Route::get('evaluasi/smart-dashboard', [EvaluasiMingguanMagangController::class, 'smartDashboard'])
        ->name('evaluasi.smartDashboard');

    // API route for getting evaluations by week (for AJAX calls)
    Route::get('/api/evaluations', [EvaluasiMingguanMagangController::class, 'getByWeek'])
        ->name('api.evaluations');

    // API route for updating evaluation ratings
    Route::post('/api/evaluations/update', [EvaluasiMingguanMagangController::class, 'updateRating'])->name('api.evaluations.update');

    // API route for getting ratings for a specific criterion
    Route::get('/api/criteria-ratings', [EvaluasiMingguanMagangController::class, 'getCriteriaRatings'])->name('api.criteria.ratings');

    // Criteria routes
    Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria.index');
    Route::get('/criteria/create', [CriteriaController::class, 'create'])->name('criteria.create');
    Route::post('/criteria', [CriteriaController::class, 'store'])->name('criteria.store');
    Route::get('/criteria/{criterion}', [CriteriaController::class, 'show'])->name('criteria.show');
    Route::get('/criteria/{criterion}/edit', [CriteriaController::class, 'edit'])->name('criteria.edit');
    Route::put('/criteria/{criterion}', [CriteriaController::class, 'update'])->name('criteria.update');
    Route::delete('/criteria/{criterion}', [CriteriaController::class, 'destroy'])->name('criteria.destroy');
    Route::delete('/criteria/{criterion}/force', [CriteriaController::class, 'forceDestroy'])->name('criteria.force-destroy');
    Route::post('/criteria/update-weights', [CriteriaController::class, 'updateWeights'])->name('criteria.update-weights');

    // Criteria Rating Scale Routes
    Route::get('/criteria-rating-scales', [CriteriaRatingScaleController::class, 'index'])->name('criteria-rating-scales.index');
    Route::get('/criteria-rating-scales/create', [CriteriaRatingScaleController::class, 'create'])->name('criteria-rating-scales.create');
    Route::post('/criteria-rating-scales', [CriteriaRatingScaleController::class, 'store'])->name('criteria-rating-scales.store');
    Route::get('/criteria-rating-scales/{ratingScale}', [CriteriaRatingScaleController::class, 'show'])->name('criteria-rating-scales.show');
    Route::get('/criteria-rating-scales/{ratingScale}/edit', [CriteriaRatingScaleController::class, 'edit'])->name('criteria-rating-scales.edit');
    Route::put('/criteria-rating-scales/{ratingScale}', [CriteriaRatingScaleController::class, 'update'])->name('criteria-rating-scales.update');
    Route::delete('/criteria-rating-scales/{ratingScale}', [CriteriaRatingScaleController::class, 'destroy'])->name('criteria-rating-scales.destroy');
    Route::get('/criteria/{criteriaId}/rating-scales', [CriteriaRatingScaleController::class, 'getByCriteria'])->name('criteria.rating-scales');

    // Criteria Comparison Routes
    Route::get('/criteria-comparisons', [CriteriaComparisonController::class, 'index'])->name('criteria-comparisons.index');
    Route::get('/criteria-comparisons/create', [CriteriaComparisonController::class, 'create'])->name('criteria-comparisons.create');
    Route::post('/criteria-comparisons', [CriteriaComparisonController::class, 'store'])->name('criteria-comparisons.store');
    Route::get('/criteria-comparisons/{comparison}', [CriteriaComparisonController::class, 'show'])->name('criteria-comparisons.show');
    Route::get('/criteria-comparisons/{comparison}/edit', [CriteriaComparisonController::class, 'edit'])->name('criteria-comparisons.edit');
    Route::put('/criteria-comparisons/{comparison}', [CriteriaComparisonController::class, 'update'])->name('criteria-comparisons.update');
    Route::delete('/criteria-comparisons/{comparison}', [CriteriaComparisonController::class, 'destroy'])->name('criteria-comparisons.destroy');
    Route::get('/criteria/{criteriaId}/comparisons', [CriteriaComparisonController::class, 'getByCriteria'])->name('criteria.comparisons');

    // Decision Support System (DSS) routes
    // AHP Routes
    Route::get('/ahp/{job_id}', [AHPController::class, 'index'])->name('ahp.index');
    Route::post('/ahp/{job_id}/save-comparisons', [AHPController::class, 'saveComparisons'])->name('ahp.save-comparisons');
    Route::get('/ahp/{job_id}/results', [AHPController::class, 'results'])->name('ahp.results');

    // SMART Routes (original implementation)
    Route::get('/smart/{job_id}', [SMARTController::class, 'index'])->name('smart.index');
    Route::post('/smart/{job_id}/apply', [SMARTController::class, 'applyRanking'])->name('smart.apply-ranking');

    // New SMART Weekly Evaluation Routes
    Route::get('/smart/evaluasi', [SMARTEvaluasiController::class, 'index'])
        ->name('smart.evaluasi');

    // Criteria Weights Routes
    Route::get('/smart/criteria/{jobId}', [SMARTEvaluasiController::class, 'showCriteriaWeights'])
        ->name('smart.criteria');
    Route::post('/smart/criteria/{jobId}/calculate', [SMARTEvaluasiController::class, 'calculateWeights'])
        ->name('smart.calculate-weights');

    // SMART Rankings Routes
    Route::get('/smart/rankings/{jobId}', [SMARTEvaluasiController::class, 'showRankings'])
        ->name('smart.rankings');
    Route::get('/smart/intern/{jobId}/{magangId}', [SMARTEvaluasiController::class, 'showInternDetail'])
        ->name('smart.intern.detail');

    // Add a temporary debug route
    Route::get('/test-evaluasi-dashboard', function() {
        return view('evaluasi.smart-dashboard', [
            'jobs' => \App\Models\Job::whereIn('job_id', ['JOB001', 'JOB004'])->get(),
            'periods' => \App\Models\Periode::all(),
            'jobId' => 'JOB001',
            'selectedPeriodeId' => \App\Models\Periode::first()->periode_id ?? null,
            'criteria' => \App\Models\Criteria::where('job_id', 'JOB001')->get(),
            'interns' => [],
            'weekCount' => 4,
            'weeklyRankings' => []
        ]);
    })->name('test.evaluasi.dashboard');
});

require __DIR__.'/auth.php';
