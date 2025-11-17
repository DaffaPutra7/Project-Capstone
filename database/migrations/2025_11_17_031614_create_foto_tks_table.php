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
        Schema::create('foto_tk', function (Blueprint $table) {
            $table->id('id_foto');
            
            // Kolom ini menghubungkan ke tabel 'profil_tk'
            $table->foreignId('id_profil')
                  ->constrained('profil_tk', 'id_profil')
                  ->onDelete('cascade'); // Jika profil dihapus, foto ikut terhapus

            $table->string('path_foto'); // Menyimpan path/nama file foto
            $table->string('deskripsi')->nullable(); // Opsional untuk caption
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_tk');
    }
};