<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_m_ruang';
    protected $primaryKey = 'id_mr';

    protected $fillable = ['id_mg', 'name_mr'];
}
