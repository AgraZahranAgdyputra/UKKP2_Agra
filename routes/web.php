<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Guest only (belum login)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Butuh login
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hak Akses — admin only (hardcoded, bukan dari tabel)
    Route::middleware('permission:permissions,can_view')->group(function () {
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::put('permissions', [PermissionController::class, 'update'])->name('permissions.update');
    });

    // CRUD dengan permission middleware
    Route::middleware('permission:users,can_view')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    Route::middleware('permission:pengaduan,can_view')->group(function () {
        Route::resource('pengaduan', PengaduanController::class);
    });

    Route::middleware('permission:tanggapan,can_view')->group(function () {
        Route::resource('tanggapan', TanggapanController::class)->except(['show']);
    });

    Route::middleware('permission:kategori,can_view')->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['show']);
    });
});
