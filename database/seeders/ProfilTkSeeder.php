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
            'misi' => "Mencintai Al Qur’an melalui kegiatan tahfidzul qur’an.\nPembiasaan 5S (senyum, salam, sapa, sopan, santun).\nMelaksanakan pembelajaran yang unggul dan kompeten.\nMemotivasi anak dalam kegiatan yang asik dan menyenangkan tanpa beban.\nMelatih anak menjadi pribadi yang mandiri, percaya diri, dan bertanggung jawab.",
            'tujuan' => "Mewujudkan generasi hafidz-hafidzah yang berakhlakul karimah.\nMembentuk generasi yang aktif, kreatif, asik, dan menyenangkan.\nMembentuk generasi yang berkepribadian serta tanggung jawab dalam menghadapi era globalisasi.",
        ]);
    }
}
