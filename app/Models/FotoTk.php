<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoTk extends Model
{
    use HasFactory;

    protected $table = 'foto_tk';
    protected $primaryKey = 'id_foto';

    protected $fillable = [
        'id_profil',
        'path_foto',
        'deskripsi',
    ];

    /**
     * Relasi 'belongsTo' ke ProfilTk
     */
    public function profilTk()
    {
        return $this->belongsTo(ProfilTk::class, 'id_profil', 'id_profil');
    }
}