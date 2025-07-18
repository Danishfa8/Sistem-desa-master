<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lansia_desas', function (Blueprint $table) {
            // Drop kolom enum lama
            $table->dropColumn('jenis_lansia');

            // Tambahkan kolom integer baru
            $table->integer('jumlah_lansia')->after('tahun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lansia_desas', function (Blueprint $table) {
            // Hapus kolom baru
            $table->dropColumn('jumlah_lansia');

            // Kembalikan kolom lama enum
            $table->enum('jenis_lansia', ['jumlah_lansia'])->after('tahun');
        });
    }
};
