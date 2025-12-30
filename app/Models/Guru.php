<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'jabatan',
        'tempat_lahir',
        'tanggal_lahir',
        'foto',
        'deskripsi',
    ];
}
