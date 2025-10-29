<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahun';
    public $timestamps = false; 
    protected $fillable = ['tahun', 'kuota_full_day', 'kuota_reguler'];
}
