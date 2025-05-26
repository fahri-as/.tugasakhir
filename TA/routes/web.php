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
use App\Http\Controllers\InterviewRatingScaleController;
use App\Http\Controllers\TesKemampuanRatingScaleController;
use Illuminate\Support\Facades\Route;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRole;

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
})->middleware(['auth', 'verified', CheckRole::class.':admin'])->name('dashboard');

// Routes accessible by all authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes accessible by cook and pastry roles
Route::middleware(['auth', CheckRole::class.':cook,pastry,admin'])->group(function () {
    // Evaluasi Mingguan routes - accessible by cook and pastry roles
    Route::resource('evaluasi', EvaluasiMingguanMagangController::class);

    // Add SMART dashboard route for Evaluasi
    Route::get('evaluasi/smart-dashboard', [EvaluasiMingguanMagangController::class, 'smartDashboard'])
        ->name('evaluasi.smartDashboard');

    // API route for getting evaluations by week (for AJAX calls)
    Route::get('/api/evaluations', [EvaluasiMingguanMagangController::class, 'getByWeek'])
        ->name('api.evaluations');

    // API route for updating evaluation ratings
    Route::post('/api/evaluations/update', [EvaluasiMingguanMagangController::class, 'updateRating'])
        ->name('api.evaluations.update');

    // API route for getting ratings for a specific criterion
    Route::get('/api/criteria-ratings', [EvaluasiMingguanMagangController::class, 'getCriteriaRatings'])
        ->name('api.criteria.ratings');

    // API route for getting evaluation data by intern ID and week
    Route::get('/api/evaluasi/get-data', [EvaluasiMingguanMagangController::class, 'getEvaluationData'])
        ->name('api.evaluasi.get-data');

    // Magang routes - read-only access for evaluations
    Route::get('magang/smart-dashboard', [MagangController::class, 'smartDashboard'])
        ->name('magang.smartDashboard');
    Route::get('magang/{magang}/weekly-scores', [MagangController::class, 'weeklyTotalScores'])
        ->name('magang.weeklyScores');
    Route::get('magang', [MagangController::class, 'index'])->name('magang.index');
    Route::get('magang/{magang}', [MagangController::class, 'show'])->name('magang.show');

    // SMART Weekly Evaluation Routes
    Route::get('/smart/evaluasi', [SMARTEvaluasiController::class, 'index'])
        ->name('smart.evaluasi');
    Route::get('/smart/criteria/{jobId}', [SMARTEvaluasiController::class, 'showCriteriaWeights'])
        ->name('smart.criteria');
    Route::get('/smart/rankings/{jobId}', [SMARTEvaluasiController::class, 'showRankings'])
        ->name('smart.rankings');
    Route::get('/smart/intern/{jobId}/{magangId}', [SMARTEvaluasiController::class, 'showInternDetail'])
        ->name('smart.intern.detail');
});

// Routes accessible only by admin
Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
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
    Route::get('/tes-kemampuan/get-rating-scales-for-pelamar/{pelamarId}', [TesKemampuanController::class, 'getRatingScalesForPelamar'])
        ->name('tes-kemampuan.get-rating-scales-for-pelamar');
    Route::get('/tes-kemampuan/{tesKemampuan}/fail', [TesKemampuanController::class, 'markAsFailed'])
        ->name('tes-kemampuan.fail');
    Route::get('/tes-kemampuan/{tesKemampuan}/pending', [TesKemampuanController::class, 'resetToPending'])
        ->name('tes-kemampuan.pending');
    Route::get('/tes-kemampuan/{tesKemampuan}/pass', [TesKemampuanController::class, 'markAsPassed'])
        ->name('tes-kemampuan.pass');
    Route::post('/tes-kemampuan/{tesKemampuan}/schedule-contract', [TesKemampuanController::class, 'scheduleContractDiscussion'])
        ->name('tes-kemampuan.schedule-contract');

    // Admin Magang routes - full access
    Route::resource('magang', MagangController::class)->except(['index', 'show']);
    Route::patch('magang/{magang}/status', [MagangController::class, 'updateStatus'])
        ->name('magang.updateStatus');
    Route::get('/magang/{magang}/pass', [MagangController::class, 'markAsPassed'])->name('magang.pass');
    Route::get('/magang/{magang}/fail', [MagangController::class, 'markAsFailed'])->name('magang.fail');
    Route::get('/magang/{magang}/pending', [MagangController::class, 'resetToPending'])->name('magang.resetToPending');
    Route::post('magang/schedule-start/{tesKemampuan}', [MagangController::class, 'scheduleStart'])
        ->name('magang.scheduleStart');

    // Criteria routes
    Route::resource('criteria', CriteriaController::class);
    Route::post('/criteria/update-weights', [CriteriaController::class, 'updateWeights'])->name('criteria.update-weights');
    Route::delete('/criteria/{criterion}/force', [CriteriaController::class, 'forceDestroy'])->name('criteria.force-destroy');

    // Criteria Rating Scale Routes
    Route::resource('criteria-rating-scales', CriteriaRatingScaleController::class);
    Route::get('/criteria/{criteriaId}/rating-scales', [CriteriaRatingScaleController::class, 'getByCriteria'])->name('criteria.rating-scales');

    // Interview Rating Scale Routes
    Route::resource('interview-rating-scales', InterviewRatingScaleController::class);
    Route::get('/interview-criteria/{criteriaId}/rating-scales', [InterviewRatingScaleController::class, 'getByCriteria'])->name('interview-criteria.rating-scales');

    // Tes Kemampuan Rating Scale Routes
    Route::resource('tes-kemampuan-rating-scales', TesKemampuanRatingScaleController::class);
    Route::get('/tes-kemampuan-criteria/{criteriaId}/rating-scales', [TesKemampuanRatingScaleController::class, 'getByCriteria'])->name('tes-kemampuan-criteria.rating-scales');

    // Criteria Comparison Routes
    Route::resource('criteria-comparisons', CriteriaComparisonController::class);
    Route::get('/criteria/{criteriaId}/comparisons', [CriteriaComparisonController::class, 'getByCriteria'])->name('criteria.comparisons');

    // Decision Support System (DSS) routes
    // AHP Routes
    Route::get('/ahp/{job_id}', [AHPController::class, 'index'])->name('ahp.index');
    Route::post('/ahp/{job_id}/save-comparisons', [AHPController::class, 'saveComparisons'])->name('ahp.save-comparisons');
    Route::get('/ahp/{job_id}/results', [AHPController::class, 'results'])->name('ahp.results');

    // SMART Routes (original implementation)
    Route::get('/smart/{job_id}', [SMARTController::class, 'index'])->name('smart.index');
    Route::post('/smart/{job_id}/apply', [SMARTController::class, 'applyRanking'])->name('smart.apply-ranking');

    // SMART Rankings admin routes
    Route::post('/smart/criteria/{jobId}/calculate', [SMARTEvaluasiController::class, 'calculateWeights'])
        ->name('smart.calculate-weights');

    // Add a temporary debug route
    Route::get('/test-evaluasi-dashboard', function(Request $request) {
        // Get job_id from request, default to JOB001 if not provided
        $jobId = $request->input('job_id', 'JOB001');
        $selectedPeriodeId = $request->input('periode_id', \App\Models\Periode::first()->periode_id ?? null);

        // Get interns through proper relationship
        $interns = \App\Models\Magang::with(['pelamar' => function($query) use ($jobId) {
            $query->where('job_id', $jobId);
        }])->whereHas('pelamar', function($query) use ($jobId) {
            $query->where('job_id', $jobId);
        })->get();

        return view('evaluasi.smart-dashboard', [
            'jobs' => \App\Models\Job::all(), // Get all jobs instead of hardcoding
            'periods' => \App\Models\Periode::all(),
            'jobId' => $jobId,
            'selectedPeriodeId' => $selectedPeriodeId,
            'criteria' => \App\Models\Criteria::where('job_id', $jobId)->get(),
            'interns' => $interns,
            'weekCount' => 4,
            'weeklyRankings' => collect([])
        ]);
    })->name('test.evaluasi.dashboard');
});

// Test routes for roles
Route::get('/test-roles', function() {
    $user = Auth::user();
    return response()->json([
        'user' => $user->username,
        'email' => $user->email,
        'role' => $user->role
    ]);
})->middleware(['auth']);

Route::get('/test-admin', function() {
    return "You are an admin";
})->middleware(['auth', \App\Http\Middleware\CheckRole::class.':admin']);

Route::get('/test-cook', function() {
    return "You are a cook";
})->middleware(['auth', \App\Http\Middleware\CheckRole::class.':cook']);

Route::get('/test-pastry', function() {
    return "You are a pastry chef";
})->middleware(['auth', \App\Http\Middleware\CheckRole::class.':pastry']);

require __DIR__.'/auth.php';
