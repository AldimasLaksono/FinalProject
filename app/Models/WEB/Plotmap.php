<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plotmap extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_t_mapel';
    protected $primaryKey = 'id_tm';

    protected $fillable = ['id_tm', 'kode_mm_tm', 'id_tpc', 'id_mm', 'id_mut'];
}
