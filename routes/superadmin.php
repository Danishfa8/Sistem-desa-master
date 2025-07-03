<?php

use App\Http\Controllers\Superadmin\PkkDesaController;
use App\Http\Controllers\Superadmin\BalitaDesaController;
use App\Http\Controllers\Superadmin\BumdeController;
use App\Http\Controllers\Superadmin\DesaController;
use App\Http\Controllers\Superadmin\KecamatanController;
use App\Http\Controllers\Superadmin\KelembagaanDesaController;
use App\Http\Controllers\Superadmin\LpmdkController;
use App\Http\Controllers\Superadmin\PendapatanDesaController;
use App\Http\Controllers\Superadmin\ProfileController;
use App\Http\Controllers\Superadmin\ProfileDesaController;
use App\Http\Controllers\Superadmin\RtRwDesaController;
use App\Http\Controllers\Superadmin\DeviceController;
use App\Http\Controllers\Superadmin\DisabilitasDesaController;
use App\Http\Controllers\Superadmin\EkonomiController;
use App\Http\Controllers\Superadmin\EnergiDesaController;
use App\Http\Controllers\Superadmin\IndustriPenghasilLimbahDesaController;
use App\Http\Controllers\Superadmin\JalanDesaController;
use App\Http\Controllers\Superadmin\JalanKabupatenDesaController;
use App\Http\Controllers\Superadmin\JembatanDesaController;
use App\Http\Controllers\Superadmin\KerawananSosialDesaController;
use App\Http\Controllers\Superadmin\KondisiLingkunganKeluargaDesaController;
use App\Http\Controllers\Superadmin\LansiaDesaController;
use App\Http\Controllers\Superadmin\OlahragaDesaController;
use App\Http\Controllers\Superadmin\PelakuUmkmDesaController;
use App\Http\Controllers\Superadmin\PendidikanDesaController;
use App\Http\Controllers\Superadmin\PengeluaranController;
use App\Http\Controllers\Superadmin\PerangkatDesaController;
use App\Http\Controllers\Superadmin\SaranaIbadahDesaController;
use App\Http\Controllers\Superadmin\SaranaKesehatanDesaController;
use App\Http\Controllers\Superadmin\SaranaLainyaDesaController;
use App\Http\Controllers\Superadmin\SaranaPendukungKesehatanDesaController;
use App\Http\Controllers\Superadmin\SettingwebsiteController;
use App\Http\Controllers\Superadmin\SumberDayaAlamDesaController;
use App\Http\Controllers\Superadmin\TempatTinggalDesaController;
use App\Http\Controllers\Superadmin\UsahaEkonomiController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        // Kecamatan
        Route::resource('kecamatans', KecamatanController::class);
        // Desa 
        Route::resource('desas', DesaController::class);
        // Route::resource('profile-desas', ProfileDesaController::class);
        Route::get('profile-desa', [ProfileDesaController::class, 'index'])->name('profile-desas.index');
        Route::get('profile-desa/{desa_id}/create', [ProfileDesaController::class, 'create'])->name('profile-desas.create');
        Route::post('profile-desa/store', [ProfileDesaController::class, 'store'])->name('profile-desas.store');
        Route::get('profile-desa/{id}/edit', [ProfileDesaController::class, 'edit'])->name('profile-desas.edit');
        Route::put('profile-desa/{id}', [ProfileDesaController::class, 'update'])->name('profile-desas.update');
        Route::delete('profile-desa/{id}', [ProfileDesaController::class, 'destroy'])->name('profile-desas.destroy');
        // Perangkat Desa
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
        // WA Gateway Fonnte
        Route::resource('devices', DeviceController::class);
        Route::post('send-message', [DeviceController::class, 'sendMessage'])->name('send.message');
        Route::post('devices/status', [DeviceController::class, 'checkDeviceStatus']);
        Route::post('devices/activate', [DeviceController::class, 'activateDevice'])->name('devices.activate');
        Route::post('devices/disconnect', [DeviceController::class, 'disconnect'])->name('devices.disconnect');

        // settings
        Route::get('/settings', [SettingwebsiteController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingwebsiteController::class, 'update'])->name('settings.update');
        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::view('superadmin/dashboard', 'superadmin.home.index');
    // Route::get('/', function () {
    //     return view('superadmin.home.index')->name('superadmin.index');
    // });
});
