<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [TrackingController::class, 'landing'])->name('landing');
Route::post('/tracking', [TrackingController::class, 'track'])->name('tracking');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Staff Panel Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Pemohon
    Route::resource('pemohon', PemohonController::class);

    // Status Update
    Route::get('/pemohon/{pemohon}/update-status', [PemohonController::class, 'updateStatusForm'])
        ->name('pemohon.update-status');
    Route::post('/pemohon/{pemohon}/update-status', [PemohonController::class, 'updateStatus'])
        ->name('pemohon.update-status.store');
});
