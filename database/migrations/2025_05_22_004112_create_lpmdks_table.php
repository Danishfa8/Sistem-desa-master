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
        Schema::create('lpmdks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->foreignId('rt_rw_desa_id')->constrained('rt_rw_desas')->onDelete('cascade');
            $table->integer('jumlah_pengurus');
            $table->integer('jumlah_anggota');
            $table->integer('jumlah_kegiatan');
            $table->integer('jumlah_buku_administrasi');
            $table->decimal('jumlah_dana', 15, 2);
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->enum('status', ['Arsip', 'Pending', 'Approved', 'Rejected'])->default('Arsip');
            $table->text('reject_reason')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpmdks');
    }
};
