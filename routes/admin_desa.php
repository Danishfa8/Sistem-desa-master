<?php

use App\Http\Controllers\AdminDesa\AjukanController;
use App\Http\Controllers\AdminDesa\PkkDesaController;
use App\Http\Controllers\AdminDesa\BalitaDesaController;
use App\Http\Controllers\AdminDesa\BumdeController;
use App\Http\Controllers\AdminDesa\DesaController;
use App\Http\Controllers\AdminDesa\KecamatanController;
use App\Http\Controllers\AdminDesa\KelembagaanDesaController;
use App\Http\Controllers\AdminDesa\LpmdkController;
use App\Http\Controllers\AdminDesa\PendapatanDesaController;
use App\Http\Controllers\AdminDesa\ProfileDesaController;
use App\Http\Controllers\AdminDesa\RtRwDesaController;
use App\Http\Controllers\AdminDesa\DisabilitasDesaController;
use App\Http\Controllers\AdminDesa\EkonomiController;
use App\Http\Controllers\AdminDesa\EnergiDesaController;
use App\Http\Controllers\AdminDesa\IndustriPenghasilLimbahDesaController;
use App\Http\Controllers\AdminDesa\JalanDesaController;
use App\Http\Controllers\AdminDesa\JalanKabupatenDesaController;
use App\Http\Controllers\AdminDesa\JembatanDesaController;
use App\Http\Controllers\AdminDesa\KerawananSosialDesaController;
use App\Http\Controllers\AdminDesa\KondisiLingkunganKeluargaDesaController;
use App\Http\Controllers\AdminDesa\LansiaDesaController;
use App\Http\Controllers\AdminDesa\OlahragaDesaController;
use App\Http\Controllers\AdminDesa\PelakuUmkmDesaController;
use App\Http\Controllers\AdminDesa\PendidikanDesaController;
use App\Http\Controllers\AdminDesa\PengeluaranController;
use App\Http\Controllers\AdminDesa\PerangkatDesaController;
use App\Http\Controllers\AdminDesa\SaranaIbadahDesaController;
use App\Http\Controllers\AdminDesa\SaranaKesehatanDesaController;
use App\Http\Controllers\AdminDesa\SaranaLainyaDesaController;
use App\Http\Controllers\AdminDesa\SaranaPendukungKesehatanDesaController;
use App\Http\Controllers\AdminDesa\SumberDayaAlamDesaController;
use App\Http\Controllers\AdminDesa\TempatTinggalDesaController;
use App\Http\Controllers\AdminDesa\UsahaEkonomiController;
use App\Models\PerangkatDesa;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin_desa'])->group(function () {
    Route::prefix('admin_desa')->name('admin_desa.')->group(function () {
        // Kecamatan
        Route::resource('kecamatans', KecamatanController::class);
        // Desa 
        Route::resource('desas', DesaController::class);
        // Route::resource('profile-desas', ProfileDesaController::class);
        Route::get('profile-desa', [ProfileDesaController::class, 'index'])->name('profile-desas');
        Route::get('profile-desa/{desa_id}/create', [ProfileDesaController::class, 'create'])->name('profile-desas.create');
        Route::post('profile-desa/store', [ProfileDesaController::class, 'store'])->name('profile-desas.store');
        Route::get('profile-desa/{id}/edit', [ProfileDesaController::class, 'edit'])->name('profile-desas.edit');
        Route::put('profile-desa/{id}', [ProfileDesaController::class, 'update'])->name('profile-desas.update');
        Route::delete('profile-desa/{id}', [ProfileDesaController::class, 'destroy'])->name('profile-desas.destroy');
        Route::resource('perangkat-desa', PerangkatDesaController::class);
        // RT/RW Desa
        Route::resource('rt-rw-desa', RtRwDesaController::class);
        // Pendapatan Desa
        Route::resource('pendapatan-desas', PendapatanDesaController::class);
        Route::resource('pengeluaran', PengeluaranController::class);
        // Kelembagaan Desa
        Route::resource('kelembagaan-desa', KelembagaanDesaController::class);
        Route::get('/get-rt-rw/{desa_id}', [KelembagaanDesaController::class, 'getRtRw'])->name('get-rt-rw');
        Route::resource('lpmdk', LpmdkController::class);
        Route::resource('bumdes', BumdeController::class);
        Route::resource('pkk-desa', PkkDesaController::class);
        // Infrastruktur Desa
        Route::resource('jembatan-desa', JembatanDesaController::class);
        Route::resource('jalan-desa', JalanDesaController::class);
        Route::resource('jalan-kabupaten-desa', JalanKabupatenDesaController::class);
        // Sosial
        Route::resource('kerawanan-sosial-desa', KerawananSosialDesaController::class);
        Route::resource('kondisi-lingkungan-keluarga-desa', KondisiLingkunganKeluargaDesaController::class);
        Route::resource('tempat-tinggal-desa', TempatTinggalDesaController::class);
        Route::resource('disabilitas-desa', DisabilitasDesaController::class);
        Route::resource('balita-desa', BalitaDesaController::class);
        Route::resource('lansia-desa', LansiaDesaController::class);
        Route::resource('pendidikan-desa', PendidikanDesaController::class);
        Route::resource('olahraga-desa', OlahragaDesaController::class);
        Route::resource('pelaku-umkm-desa', PelakuUmkmDesaController::class);
        // Sarana & Prasarana
        Route::resource('sarana-kesehatan-desa', SaranaKesehatanDesaController::class);
        Route::resource('sarana-pendukung-kesehatan-desa', SaranaPendukungKesehatanDesaController::class);
        Route::resource('sarana-ibadah-desa', SaranaIbadahDesaController::class);
        Route::resource('sarana-lainya-desa', SaranaLainyaDesaController::class);
        Route::resource('ekonomi', EkonomiController::class);
        Route::resource('usaha-ekonomi', UsahaEkonomiController::class);

        // Industri & Energi
        Route::resource('industri-penghasil-limbah-desa', IndustriPenghasilLimbahDesaController::class);
        Route::resource('energi-desa', EnergiDesaController::class);
        // Sumber Daya Alam
        Route::resource('sumber-daya-alam-desa', SumberDayaAlamDesaController::class);
        // Pengajuan
        Route::patch('{resource}/{id}/ajukan', [AjukanController::class, 'ajukan'])
            ->name('universal.ajukan')
            ->where('resource', '[a-z-]+')
            ->where('id', '[0-9]+');
    });
    Route::view('admin_desa/dashboard', 'admin_desa.home.index');
    // Route::get('/', function () {
    //     return view('superadmin.home.index')->name('superadmin.index');
    // });
});
