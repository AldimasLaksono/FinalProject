<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_t_presensi';
    protected $primaryKey = 'id_tp';

    protected $fillable = ['id_mus', 'status', 'latitude', 'longitude'];
}
