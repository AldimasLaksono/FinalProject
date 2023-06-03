<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_m_jabatan';
    protected $primaryKey = 'id_mja';

    protected $fillable = ['id_mja', 'name_mja'];
}
