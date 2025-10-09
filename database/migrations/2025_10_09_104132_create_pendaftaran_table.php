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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            // Foreign Key ke tabel users
            $table->foreignId('id_user')->references('id_user')->on('users')->onDelete('cascade');
            // Foreign Key ke tabel tahun_ajaran
            $table->foreignId('id_tahun')->nullable()->references('id_tahun')->on('tahun_ajaran')->onDelete('set null');
            
            $table->enum('jenis_program', ['Full Day', 'Reguler']);
            $table->date('tanggal_daftar');
            $table->enum('status', ['Diterima', 'Menunggu', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
