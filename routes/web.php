<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KtpMasukController;
use App\Http\Controllers\KtpPengambilanController;
use App\Http\Controllers\KtpSelesaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () =>
            redirect()->route('admin.ktp_masuk')
        )->name('dashboard');

        Route::get('/ktp-masuk', [KtpMasukController::class, 'index'])
            ->name('ktp_masuk');

        Route::post('/ktp-masuk', [KtpMasukController::class, 'store'])
            ->name('ktp_masuk.store');

        Route::get('/ktp-masuk/{id}/edit', [KtpMasukController::class, 'edit'])
            ->name('ktp_masuk.edit');

        Route::put('/ktp-masuk/{id}', [KtpMasukController::class, 'update'])
            ->name('ktp_masuk.update');

        Route::patch('/ktp-masuk/{id}/complete', [KtpMasukController::class, 'complete'])
            ->name('ktp_masuk.complete');

        Route::delete('/ktp-masuk/{id}', [KtpMasukController::class, 'destroy'])
            ->name('ktp_masuk.destroy');

        Route::get('/ktp-pengambilan', [KtpPengambilanController::class, 'index'])
            ->name('ktp_pengambilan');

        Route::post('/ktp-pengambilan', [KtpPengambilanController::class, 'store'])
            ->name('ktp_pengambilan.store');

        Route::get('/ktp-selesai', [KtpSelesaiController::class, 'index'])
            ->name('ktp_selesai');
    });
    
/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

     
        Route::get('/dashboard', fn () =>
            redirect()->route('petugas.ktp_pengambilan')
        )->name('dashboard');

        Route::get('/ktp-pengambilan', [KtpPengambilanController::class, 'index'])
            ->name('ktp_pengambilan');

        Route::post('/ktp-pengambilan', [KtpPengambilanController::class, 'store'])
            ->name('ktp_pengambilan.store');

        Route::patch('/ktp-pengambilan/{id}/complete', [KtpMasukController::class, 'markComplete'])
            ->name('ktp_pengambilan.complete');

        Route::get('/ktp-selesai', [KtpSelesaiController::class, 'index'])
            ->name('ktp_selesai');
    });