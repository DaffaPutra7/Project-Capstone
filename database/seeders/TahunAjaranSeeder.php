<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat tahun ajaran 2025/2026
        TahunAjaran::create([
            'tahun' => '2025/2026',
            'kuota_full_day' => 50, // Ganti dengan kuota sebenarnya
            'kuota_reguler' => 50,  // Ganti dengan kuota sebenarnya
        ]);

        // Buat tahun ajaran sebelumnya (jika perlu)
        TahunAjaran::create([
            'tahun' => '2024/2025',
            'kuota_full_day' => 40,
            'kuota_reguler' => 40,
        ]);
    }
}
