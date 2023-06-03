<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'tb_t_materi';
    protected $primaryKey = 'id_tmat';
    public $timestamps = true;

    protected $fillable = [
        'id_tm',
        'judul_tmat',
        'desk_tmat',
        'gmb_tmat',
        'file_tmat',
        'status_tmat',
    ];
}
