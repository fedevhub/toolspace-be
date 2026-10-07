<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('role:admin,petugas,peminjam');

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::apiResource('users', UserController::class);
        Route::apiResource('kategori', KategoriController::class);
        Route::apiResource('alat', AlatController::class)->except(['index', 'show']);
        Route::apiResource('peminjaman', PeminjamanController::class)->only(['update', 'destroy']);
        Route::apiResource('pengembalian', PengembalianController::class)->only(['update', 'destroy']);
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index']);
    });

    Route::apiResource('alat', AlatController::class)
        ->only(['index', 'show'])
        ->middleware('role:admin,peminjam');

    Route::apiResource('peminjaman', PeminjamanController::class)
        ->only(['index', 'show'])
        ->middleware('role:admin,petugas');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])
        ->middleware('role:admin,peminjam');
    Route::patch('/peminjaman/{peminjaman}/approval', [PeminjamanController::class, 'approve'])
        ->middleware('role:petugas');

    Route::apiResource('pengembalian', PengembalianController::class)
        ->only(['index', 'show'])
        ->middleware('role:admin,petugas');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])
        ->middleware('role:admin,peminjam');
});
