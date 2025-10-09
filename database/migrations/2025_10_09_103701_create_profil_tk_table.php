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
        Schema::create('profil_tk', function (Blueprint $table) {
            $table->id('id_profil'); // Sesuai dengan .sql
            $table->string('nama_tk', 100);
            $table->text('alamat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('kontak', 100)->nullable();
            // Laravel otomatis menambahkan created_at dan updated_at
            // jika Anda menggunakan $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_tk');
    }
};
