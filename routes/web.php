<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemohonController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [TrackingController::class, 'landing'])->name('landing');

Route::get('/migrate', function () {
    try {
        $output = '';
        DB::statement('DROP TABLE IF EXISTS users, password_reset_tokens, failed_jobs, personal_access_tokens, pemohon, status_histories, migrations');
        $output .= "Tables dropped.\n";
        Artisan::call('migrate', ['--force' => true]);
        $output .= Artisan::output();
        Artisan::call('db:seed', ['--force' => true]);
        $output .= Artisan::output();
        return 'Migration & Seeding successful: <pre>' . $output . '</pre>';
    } catch (\Exception $e) {
        return 'Migration/Seeding failed: ' . $e->getMessage() . '<br><pre>' . Artisan::output() . '</pre>';
    }


});

Route::post('/tracking', [TrackingController::class, 'track'])->name('tracking');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/masuk-petugas', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/masuk-petugas', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Staff Panel Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/panel-pusat', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Pemohon
    Route::resource('pemohon', PemohonController::class);

    // Status Update
    Route::get('/pemohon/{pemohon}/update-status', [PemohonController::class, 'updateStatusForm'])
        ->name('pemohon.update-status');
    Route::post('/pemohon/{pemohon}/update-status', [PemohonController::class, 'updateStatus'])
        ->name('pemohon.update-status.store');

    Route::get('/pemohon/{pemohon}/whatsapp', [PemohonController::class, 'whatsapp'])
        ->name('pemohon.whatsapp');
});
