<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'tb_t_presensi';

    protected $fillable = [
        'id_tp',
        'id_mus',
        'status',
        'tanggal',
        'latitude',
        'longitude'
    ];
}
