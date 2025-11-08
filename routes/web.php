<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/submit', function () {
    return view('submit');
});

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes admin protégées
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/submissions', [AdminController::class, 'submissions'])->name('submissions');
    Route::post('/submissions/{id}/approve', [AdminController::class, 'approveSubmission'])->name('submissions.approve');
    Route::post('/submissions/{id}/reject', [AdminController::class, 'rejectSubmission'])->name('submissions.reject');
    Route::get('/agencies', [AdminController::class, 'agencies'])->name('agencies');
    Route::get('/contributors', [AdminController::class, 'contributors'])->name('contributors');
    Route::get('/export/agencies', [AdminController::class, 'exportAgencies'])->name('export.agencies');
    Route::get('/export/agencies/pdf', [AdminController::class, 'exportAgenciesPdf'])->name('export.agencies.pdf');
    Route::get('/export/contributors', [AdminController::class, 'exportContributors'])->name('export.contributors');
    Route::get('/export/contributors/pdf', [AdminController::class, 'exportContributorsPdf'])->name('export.contributors.pdf');
    Route::get('/export/submissions', [AdminController::class, 'exportSubmissions'])->name('export.submissions');
    Route::get('/export/submissions/pdf', [AdminController::class, 'exportSubmissionsPdf'])->name('export.submissions.pdf');
});
