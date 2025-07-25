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
        Schema::table('disabilitas_desas', function (Blueprint $table) {
            //
            Schema::table('disabilitas_desas', function (Blueprint $table) {
                $table->integer('jumlah')->default(0)->after('jenis_disabilitas');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disabilitas_desas', function (Blueprint $table) {
            //
            Schema::table('disabilitas_desas', function (Blueprint $table) {
                $table->dropColumn('jumlah');
            });
        });
    }
};
