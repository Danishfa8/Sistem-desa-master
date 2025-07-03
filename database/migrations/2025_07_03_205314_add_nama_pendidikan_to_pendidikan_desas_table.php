<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendidikan_desas', function (Blueprint $table) {
            $table->string('nama_pendidikan')->after('jenis_pendidikan');
        });
    }

    public function down(): void
    {
        Schema::table('pendidikan_desas', function (Blueprint $table) {
            $table->dropColumn('nama_pendidikan');
        });
    }
};
