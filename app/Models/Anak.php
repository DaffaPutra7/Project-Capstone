<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    protected $table = 'anak'; // Mendefinisikan nama tabel
    protected $primaryKey = 'id_anak'; // Mendefinisikan primary key
}
