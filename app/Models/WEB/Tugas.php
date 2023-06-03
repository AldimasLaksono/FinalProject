<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tb_m_tugas';
    protected $primaryKey = 'id_mt';
    public $timestamps = true;

    protected $fillable = [
        'id_mt',
        'id_tc',
        'id_mut',
        'desk_tj',
        'gmb_tj',
        'file_tj',
        'status',
        'deadline_tt',
    ];
}
