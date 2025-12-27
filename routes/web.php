<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KtpMasukController;
use App\Http\Controllers\KtpPengambilanController;
use App\Http\Controllers\KtpSelesaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/admin/ktp_masuk');
    });

    Route::get('/ktp_masuk', [KtpMasukController::class, 'index'])->name('admin.ktp_masuk');
    Route::post('/ktp_masuk', [KtpMasukController::class, 'store']);
    Route::get('/ktp_masuk/{id}/edit', [KtpMasukController::class, 'edit']);
    Route::put('/ktp_masuk/{id}', [KtpMasukController::class, 'update']);
    Route::patch('/ktp_masuk/{id}/complete', [KtpMasukController::class, 'markComplete']);
    Route::delete('/ktp_masuk/{id}', [KtpMasukController::class, 'destroy']);

    Route::get('/ktp_pengambilan', [KtpPengambilanController::class, 'index'])->name('admin.ktp_pengambilan');
    Route::post('/ktp_pengambilan', [KtpPengambilanController::class, 'store']);

    Route::get('/ktp_selesai', [KtpSelesaiController::class, 'index'])->name('admin.ktp_selesai');
});
