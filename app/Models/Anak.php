<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anak extends Model
{
    use HasFactory;
    protected $table = 'anak'; 
    protected $primaryKey = 'id_anak'; 

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

    /**
     *  untuk menghitung usia (hanya angka tahun).
     */
    public function getUsiaTahunAttribute()
    {
        if (!$this->tanggal_lahir) {
            return null;
        }
        return Carbon::parse($this->tanggal_lahir)->diffInYears(now());
    }

    /**
     *  untuk menampilkan usia dalam format "X tahun, Y bulan".
     */
    public function getUsiaDetailAttribute()
    {
        if (!$this->tanggal_lahir) {
            return 'Tgl Lahir Kosong';
        }
        return Carbon::parse($this->tanggal_lahir)->diff(now())->format('%y tahun, %m bulan');
    }

    /**
     *  untuk status pemenuhan syarat usia (Min 4, Max 5).
     */
    public function getStatusUsiaAttribute()
    {
        $usiaTahun = $this->getUsiaTahunAttribute(); 

        if ($usiaTahun === null) {
            return 'N/A';
        }

        // Syarat: Minimal 4 tahun DAN Maksimal 5 tahun
        if ($usiaTahun >= 4 && $usiaTahun <= 5) {
            return 'Memenuhi Syarat';
        } else {
            return 'Tidak Memenuhi Syarat';
        }
    }
}
