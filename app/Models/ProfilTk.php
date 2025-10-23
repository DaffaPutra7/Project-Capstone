<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilTk extends Model
{
    use HasFactory;

    protected $table = 'profil_tk';

    protected $primaryKey = 'id_profil';

    public $timestamps = false;

    protected $fillable = [
        'nama_tk',
        'visi',
        'misi',
        'tujuan',
        'motto',
    ];
}
