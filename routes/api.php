<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('map')->group(function () {
    Route::get('/kecamatan', [LocationController::class, 'getKecamatan']);
    Route::get('/desa/{kecamatanId}', [LocationController::class, 'getDesa']);
    Route::get('/kategori/{desaId}', [LocationController::class, 'getKategori']);
    Route::get('/all-data', [LocationController::class, 'getAllData']);
});


Route::get('/tes', function () {
    return ['message' => 'tes route api jalan'];
});
