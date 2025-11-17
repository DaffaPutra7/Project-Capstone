<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilTk extends Model
{
    use HasFactory;

    protected $table = 'profil_tk';
    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'nama_tk',
        'visi',
        'misi',
        'tujuan',
        'motto',
    ];

    public function foto()
    {
        return $this->hasMany(FotoTk::class, 'id_profil', 'id_profil');
    }
}
