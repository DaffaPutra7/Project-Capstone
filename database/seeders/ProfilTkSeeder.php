<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilTk;

class ProfilTkSeeder extends Seeder
{
    public function run(): void
    {
        ProfilTk::create([
            'nama_tk' => 'TK Aisyiyah Bustanul Athfal Banjareja',
            'visi' => 'Mewujudkan anak didik menjadi generasi yang berakhlakul karimah, aktif, kreatif, asik, dan bertanggung jawab.',
            'misi' => '1. Mencintai Al Qur’an melalui kegiatan tahfidzul qur’an.<br>2. Pembiasaan 5S (senyum, salam, sapa, sopan, santun).<br>3. Melaksanakan pembelajaran yang unggul dan kompeten.<br>4. Memotivasi anak dalam kegiatan yang asik dan menyenangkan tanpa beban.<br>5. Melatih anak menjadi pribadi yang mandiri, percaya diri, dan bertanggung jawab.',
            'tujuan' => '1. Mewujudkan generasi hafidz-hafidzah yang berakhlakul karimah.<br>2. Membentuk generasi yang aktif, kreatif, asik, dan menyenangkan.<br>3. Membentuk generasi yang berkepribadian serta tanggung jawab dalam menghadapi era globalisasi.',
            'motto' => 'Membentuk generasi “BAKAT” berakhlakul karimah, aktif, kreatif, asik, dan tanggung jawab.'
        ]);
    }
}
