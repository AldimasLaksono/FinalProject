<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_m_mapel';
    protected $primaryKey = 'id_mm';

    protected $fillable = ['id_mm', 'name_mm'];
}
