<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_m_period';
    protected $primaryKey = 'id_mper';

    protected $fillable = ['name_mper','status_mp'];
}
