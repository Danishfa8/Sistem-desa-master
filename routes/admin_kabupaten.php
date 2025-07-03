<?php

use App\Http\Controllers\AdminKabupaten\ApprovalController;
use App\Http\Controllers\AdminKabupaten\DashboardController;
use App\Http\Controllers\AdminKabupaten\GenericDataController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin_kabupaten'])->group(function () {
    Route::prefix('admin_kabupaten')->name('admin_kabupaten.')->group(function () {
        Route::view('/dashboard', 'admin_kabupaten.dashboard')->name('dashboard');
        Route::get('kecamatans', [DashboardController::class, 'kecamatan'])->name('kecamatan');
        Route::get('desas', [DashboardController::class, 'desa'])->name('desa');
        Route::get('profile-desa', [DashboardController::class, 'profileDesa'])->name('profile-desa');
        Route::get('rt-rw-desa', [DashboardController::class, 'rtRwDesa'])->name('rtRwDesa');
        Route::get('perangkat-desa', [DashboardController::class, 'perangkatDesa'])->name('perangkat-desa');
        Route::get('pendapatan-desas', [DashboardController::class, 'pendapatanDesa'])->name('pendapatan-desas');


        // Generic data route
        Route::get('/{type}', [GenericDataController::class, 'show'])
            ->where('type', 'kelembagaan-desa|bumdes|lpmdk|pkk-desa|jembatan-desa|jalan-desa|jalan-kabupaten-desa|kerawanan-sosial-desa|kondisi-lingkungan-keluarga-desa|tempat-tinggal-desa|disabilitas-desa|balita-desa|lansia-desa|pendidikan-desa|olahraga-desa|pelaku-umkm-desa|sarana-kesehatan-desa|sarana-pendukung-kesehatan-desa|sarana-ibadah-desa|sarana-lainya-desa|industri-penghasil-limbah-desa|energi-desa|sumber-daya-alam-desa|pengeluaran|ekonomi|usaha-ekonomi')
            ->name('show');

        // Approval route
        // Route::put('/{table}/{id}/approval', [ApprovalController::class, 'approve'])
        //     ->name('approval');
    });
});
