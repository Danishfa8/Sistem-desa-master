<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('balita_desas', function (Blueprint $table) {
            // Ubah nama kolom dan tipe datanya
            $table->dropColumn('jenis_balita');
            $table->integer('jumlah_balita')->after('tahun');
        });
    }

    public function down(): void
    {
        Schema::table('balita_desas', function (Blueprint $table) {
            $table->dropColumn('jumlah_balita');
            $table->enum('jenis_balita', ['jumlah_balita'])->after('tahun');
        });
    }
};
