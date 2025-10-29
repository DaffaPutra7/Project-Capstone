<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    protected $table = 'anak'; // Mendefinisikan nama tabel
    protected $primaryKey = 'id_anak'; // Mendefinisikan primary key

    protected $fillable = [
        'id_pendaftaran',
        'nama_lengkap',
        'nama_panggilan',
        'nik_anak',
        'anak_ke',
        'nomor_akte',
        'asal_sekolah',
        'nisn',
        'riwayat_penyakit',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'agama',
        'kewarganegaraan',
        'jml_saudara_kandung',
        'jml_saudara_tiri',
        'jml_saudara_angkat',
        'bahasa_sehari_hari',
        'berat_badan',
        'tinggi_badan',
        'golongan_darah',
        'foto_anak',
        'nama_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'pekerjaan_wali',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
    }
}
