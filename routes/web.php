<?php

use App\Http\Controllers\AdminKabupaten\ApprovalController;
use App\Http\Controllers\DataAngkaController;
use App\Http\Controllers\DataDalamPetaController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileDesaController;
use App\Http\Controllers\Superadmin\KelembagaanDesaController;
use App\Http\Controllers\InformasiDesaController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BukuDesaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('profile-desa', [ProfileDesaController::class, 'index'])->name('profile.desa');
// Route::get('data-angka', [DataAngkaController::class, 'index'])->name('data.angka');
Route::get('/get-rt-rw/{desa_id}', [KelembagaanDesaController::class, 'getRtRw'])->name('get-rt-rw');
Route::get('/profile-desa/show-desa/{kecamatan_id}', [ProfileDesaController::class, 'showDesa'])->name('profile.show-desa');
Route::get('/detail-desa/{desa_id}', [ProfileDesaController::class, 'detailDesa'])->name('detail.desa');
Route::get('/desa-section/{desaId}/{section}', [ProfileDesaController::class, 'getDesaSection'])->name('desa.section');

// peta.php
// Route::get('/desa-dalam-peta', [DataDalamPetaController::class, 'index'])->name('peta.dinamik');
// Route::get('/desa-dalam-peta/get-tahun/{kategori}', [DataDalamPetaController::class, 'getTahunByKategori']);
// Route::get('/api/geojson/desa/{kecamatan_id}', [DataDalamPetaController::class, 'geojsonDesa']);
//uji coba
Route::get('/desa-dalam-peta', [DataDalamPetaController::class, 'index'])->name('peta.dinamik');
Route::get('/desa-dalam-peta/get-desa/{kecamatan_id}', [DataDalamPetaController::class, 'getDesa']);
Route::get('/desa-dalam-peta/get-tahun/{kategori}', [DataDalamPetaController::class, 'getTahun']);
Route::get('/desa-dalam-peta/geojson', [DataDalamPetaController::class, 'getGeojson']);
Route::get('/desa-dalam-peta/detail-desa', [DataDalamPetaController::class, 'getDetailDesa']);
Route::get('/desa-dalam-peta/marker', [DataDalamPetaController::class, 'getMarkerData'])->name('peta.marker');
Route::get('/api/desa-by-kecamatan/{id}', function ($id) {
    return \App\Models\Desa::where('kecamatan_id', $id)->select('id', 'nama_desa')->get();
});
Route::get('/desa-dalam-peta/marker-detail', [DataDalamPetaController::class, 'getMarkerDetail']);




// Route::get('/desa-dalam-peta', [DataDalamPetaController::class, 'index'])->name('peta.dinamik');
// Route::get('/map/kecamatan/{kecamatanId}/desa', [DataDalamPetaController::class, 'getDesaByKecamatan']);
// Route::get('/map/desa/{desaId}/kategori-data', [DataDalamPetaController::class, 'getKategoriData']);
// Route::get('/tahun-by-kategori', [DataDalamPetaController::class, 'getTahunByKategori']);
// // Route untuk ambil tahun berdasarkan kategori via AJAX
// Route::get('/api/tahun/{kategori}', [DataDalamPetaController::class, 'getTahunByKategori'])->name('api.tahun');
// Route::get('/desa-dalam-peta/get-tahun/{kategori}', [DataDalamPetaController::class, 'getTahunByKategori']);
// Route::get('/api/geojson/desa/{kecamatan_id}', [App\Http\Controllers\DataDalamPetaController::class, 'geojsonDesa']);

// Route::prefix('map')->name('map.')->group(function () {
//     // Basic data endpoints

//     // Route::get('/kecamatan', [LocationController::class, 'getKecamatan'])->name('kecamatan');
//     // Route::get('/desa/{kecamatanId}', [LocationController::class, 'getDesa'])->name('desa');
//     // Route::get('/desa/{desa}/kategori-data', [LocationController::class, 'getKategoriDataByDesa'])->name('kategori-data');

//     // // Additional endpoints
//     // Route::get('/all-data', [LocationController::class, 'getAllData'])->name('all-data');
//     // Route::get('/desa/{desa}/kategori/{type}', [LocationController::class, 'getKategoriByType'])->name('kategori-by-type');
//     // Route::get('/statistics', [LocationController::class, 'getStatistics'])->name('statistics');

//     // // Tambahkan route ini
//     // Route::get('/desa/{desaId}/boundary', [LocationController::class, 'getDesaBoundary']);
//     // Route::post('/clear-cache', [LocationController::class, 'clearCache'])->name('clear-cache');
// });

// Ex
Route::get('/desa-dalam-angka', [DataAngkaController::class, 'index'])->name('data.index');
Route::post('/data-angka/get-by-category', [DataAngkaController::class, 'getDataByCategory'])->name('data.getByCategory');
Route::post('/data-angka/get-desa', [DataAngkaController::class, 'getDesaByKecamatan'])->name('data.getDesaByKecamatan');
Route::post('/get-tahun-by-desa', [DataAngkaController::class, 'getTahunByDesa'])->name('data.getTahunByDesa');
Route::post('/data-angka/get-result', [DataAngkaController::class, 'getResult'])->name('data.getResult');
Route::post('/data-angka/get-detail-result', [DataAngkaController::class, 'detailResult'])->name('data.getDetailResult');
Route::post('/data/download-pdf', [DataAngkaController::class, 'downloadPdf'])->name('data.downloadPdf');
Route::post('/data/download-excel', [DataAngkaController::class, 'downloadExcel'])->name('data.downloadExcel');
// Debug routes (hapus setelah selesai debugging)
Route::get('/debug-table-structure', [DataAngkaController::class, 'debugTableStructure'])->name('debug.tableStructure');
Route::get('/debug-query', [DataAngkaController::class, 'debugQuery'])->name('debug.query');

// Tambahkan route untuk Buku Desa
// Route::get('/desa-dalam-buku', [BukuDesaController::class, 'index'])->name('desa-dalam-buku');
// Route::get('/desa-dalam-buku/data', [BukuDesaController::class, 'getData'])->name('desa-dalam-buku.data');
// Route::get('/desa-dalam-buku/pdf', [BukuDesaController::class, 'generatePdf'])->name('desa-dalam-buku.pdf');
// Route::get('/desa-dalam-buku/download', [BukuDesaController::class, 'downloadPdf'])->name('desa-dalam-buku.download');



//Route Informasi Data
Route::get('/informasi-data', [InformasiDesaController::class, 'index'])->name('data.informasi');

// ApprovalController
Route::put('/{table}/{id}/approval', [ApprovalController::class, 'approve'])
    ->name('approval');

require __DIR__ . '/auth.php';
require __DIR__ . '/superadmin.php';
require __DIR__ . '/admin_desa.php';
require __DIR__ . '/admin_kabupaten.php';
require __DIR__ . '/api.php';
