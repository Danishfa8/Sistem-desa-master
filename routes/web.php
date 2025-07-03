<?php

use App\Http\Controllers\AdminKabupaten\ApprovalController;
use App\Http\Controllers\DataAngkaController;
use App\Http\Controllers\DataDalamPetaController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileDesaController;
use App\Http\Controllers\Superadmin\KelembagaanDesaController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('profile-desa', [ProfileDesaController::class, 'index'])->name('profile.desa');
// Route::get('data-angka', [DataAngkaController::class, 'index'])->name('data.angka');
Route::get('/get-rt-rw/{desa_id}', [KelembagaanDesaController::class, 'getRtRw'])->name('get-rt-rw');
Route::get('/profile-desa/show-desa/{kecamatan_id}', [ProfileDesaController::class, 'showDesa'])->name('profile.show-desa');
Route::get('/detail-desa/{desa_id}', [ProfileDesaController::class, 'detailDesa'])->name('detail.desa');
Route::get('/desa-section/{desaId}/{section}', [ProfileDesaController::class, 'getDesaSection'])->name('desa.section');

// web.php
Route::get('/desa-dalam-peta', [DataDalamPetaController::class, 'index'])->name('peta.dinamik');
Route::prefix('map')->name('map.')->group(function () {
    // Basic data endpoints
    Route::get('/kecamatan', [LocationController::class, 'getKecamatan'])->name('kecamatan');
    Route::get('/desa/{kecamatanId}', [LocationController::class, 'getDesa'])->name('desa');
    Route::get('/desa/{desa}/kategori-data', [LocationController::class, 'getKategoriDataByDesa'])->name('kategori-data');

    // Additional endpoints
    Route::get('/all-data', [LocationController::class, 'getAllData'])->name('all-data');
    Route::get('/desa/{desa}/kategori/{type}', [LocationController::class, 'getKategoriByType'])->name('kategori-by-type');
    Route::get('/statistics', [LocationController::class, 'getStatistics'])->name('statistics');

    // Tambahkan route ini
    Route::get('/desa/{desaId}/boundary', [LocationController::class, 'getDesaBoundary']);
    Route::post('/clear-cache', [LocationController::class, 'clearCache'])->name('clear-cache');
});

// Ex
Route::get('/desa-dalam-angka', [DataAngkaController::class, 'index'])->name('data.index');
Route::post('/data-angka/get-by-category', [DataAngkaController::class, 'getDataByCategory'])->name('data.getByCategory');
Route::post('/data-angka/get-desa-by-kecamatan', [DataAngkaController::class, 'getDesaByKecamatan'])->name('data.getDesaByKecamatan');
Route::post('/data-angka/get-result', [DataAngkaController::class, 'getResult'])->name('data.getResult');
// Debug routes (hapus setelah selesai debugging)
Route::get('/debug-table-structure', [DataAngkaController::class, 'debugTableStructure'])->name('debug.tableStructure');
Route::get('/debug-query', [DataAngkaController::class, 'debugQuery'])->name('debug.query');

// ApprovalController
Route::put('/{table}/{id}/approval', [ApprovalController::class, 'approve'])
    ->name('approval');

require __DIR__ . '/auth.php';
require __DIR__ . '/superadmin.php';
require __DIR__ . '/admin_desa.php';
require __DIR__ . '/admin_kabupaten.php';
require __DIR__ . '/api.php';
