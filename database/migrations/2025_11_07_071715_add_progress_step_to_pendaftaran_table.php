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
            Schema::table('pendaftaran', function (Blueprint $table) {
                // Default 1, artinya saat baru dibuat, user ada di step 1
                $table->tinyInteger('progress_step')->default(1)->after('status');
            });
        }
    /**
     * Reverse the migrations.
     */
    public function down(): void
        {
            Schema::table('pendaftaran', function (Blueprint $table) {
                $table->dropColumn('progress_step');
            });
        }
};
