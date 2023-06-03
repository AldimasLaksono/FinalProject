<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_m_gedung';
    protected $primaryKey = 'id_mg';

    protected $fillable = ['name_mg'];
}
