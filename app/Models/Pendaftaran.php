<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $primaryKey = 'id_pendaftaran';

    protected $fillable = [
        'id_user',
        'id_tahun',
        'jenis_program',
        'tanggal_daftar',
        'status',
        'no_hp',
    ];

    public function anak()
    {
        return $this->hasOne(Anak::class, 'id_pendaftaran', 'id_pendaftaran');
    }
}
