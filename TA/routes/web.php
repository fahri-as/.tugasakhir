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
use App\Http\Controllers\CriteriaController;
use Illuminate\Support\Facades\Route;
use App\Models\Periode;

Route::get('/', function () {
    $periodes = Periode::with('jobs')->get();
    return view('welcome', compact('periodes'));
});

// This route is accessible to everyone (public)
Route::post('/apply', [PelamarController::class, 'store'])->name('pelamar.public.store');

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

    // Tes Kemampuan routes
    Route::resource('tes-kemampuan', TesKemampuanController::class);

    // Magang routes
    Route::resource('magang', MagangController::class);
    Route::patch('magang/{magang}/status', [MagangController::class, 'updateStatus'])
        ->name('magang.update-status');

    // Evaluasi Mingguan routes
    Route::resource('evaluasi', EvaluasiMingguanMagangController::class);

    // Criteria routes
    Route::resource('criteria', CriteriaController::class);
    Route::post('criteria/update-weights', [CriteriaController::class, 'updateWeights'])
        ->name('criteria.update-weights');

    // Decision Support System (DSS) routes
    // AHP Routes
    Route::get('/ahp/{job_id}', [AHPController::class, 'index'])->name('ahp.index');
    Route::post('/ahp/{job_id}/save-comparisons', [AHPController::class, 'saveComparisons'])->name('ahp.save-comparisons');

    // SMART Routes
    Route::get('/smart/{job_id}', [SMARTController::class, 'index'])->name('smart.index');
    Route::post('/smart/{job_id}/apply', [SMARTController::class, 'applyRanking'])->name('smart.apply-ranking');
});

require __DIR__.'/auth.php';
