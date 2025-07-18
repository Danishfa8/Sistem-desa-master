<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelaku_umkm_desas', function (Blueprint $table) {
            $table->dropColumn('jenis_pelaku_umkm'); // Hapus kolom lama
            $table->integer('jumlah_umkm')->after('tahun'); // Tambah kolom baru
        });
    }

    public function down(): void
    {
        Schema::table('pelaku_umkm_desas', function (Blueprint $table) {
            $table->dropColumn('jumlah_umkm'); // Revert kolom baru
            $table->enum('jenis_pelaku_umkm', ['Jumlah UMKM'])->after('tahun'); // Tambahkan kembali kolom lama
        });
    }
};
