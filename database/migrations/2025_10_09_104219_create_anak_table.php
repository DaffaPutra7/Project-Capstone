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
    Schema::create('anak', function (Blueprint $table) {
        $table->id('id_anak');
        $table->foreignId('id_pendaftaran')->references('id_pendaftaran')->on('pendaftaran')->onDelete('cascade');

        $table->string('nama_lengkap', 100)->nullable(); 
        
        $table->string('nama_panggilan', 50)->nullable(); 
        $table->string('nik_anak', 20)->unique()->nullable();
        $table->tinyInteger('anak_ke')->nullable(); 
        $table->string('nomor_akte', 100)->nullable(); 
        $table->string('foto_anak', 255)->nullable(); 

        $table->string('asal_sekolah', 100)->nullable(); 
        $table->string('nisn', 20)->nullable(); 
        $table->text('riwayat_penyakit')->nullable(); 
        $table->string('tempat_lahir', 50)->nullable(); 
        $table->date('tanggal_lahir')->nullable(); 
        $table->text('alamat')->nullable(); 
        $table->enum('jenis_kelamin', ['Laki-laki','Perempuan'])->nullable(); 
        $table->string('agama', 30)->nullable();
        $table->enum('kewarganegaraan', ['Indonesia', 'WNA'])->nullable();
        $table->string('bahasa_sehari_hari', 50)->nullable(); 
        $table->decimal('berat_badan', 5, 2)->nullable(); 
        $table->decimal('tinggi_badan', 5, 2)->nullable(); 
        $table->string('golongan_darah', 5)->nullable();

        $table->string('nama_ayah', 100)->nullable(); 
        $table->string('tempat_lahir_ayah', 50)->nullable(); 
        $table->date('tanggal_lahir_ayah')->nullable();
        $table->string('pendidikan_ayah', 50)->nullable(); 
        $table->string('pekerjaan_ayah', 100)->nullable();

        $table->string('nama_ibu', 100)->nullable();
        $table->string('tempat_lahir_ibu', 50)->nullable();
        $table->date('tanggal_lahir_ibu')->nullable(); 
        $table->string('pendidikan_ibu', 50)->nullable(); 
        $table->string('pekerjaan_ibu', 100)->nullable(); 

        $table->string('nama_wali', 100)->nullable(); 
        $table->string('pekerjaan_wali', 100)->nullable(); 

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
