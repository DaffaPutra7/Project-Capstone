<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->enum('tipe_daftar', ['Online', 'Offline'])->default('Online')->after('jenis_program');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn('tipe_daftar');
        });
    }
};