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
            
            $table->foreignId('id_profil')
                  ->constrained('profil_tk', 'id_profil')
                  ->onDelete('cascade'); 

            $table->string('path_foto'); 
            $table->string('deskripsi')->nullable(); 
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