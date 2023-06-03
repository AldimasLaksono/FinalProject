<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAnswer extends Model
{
    use HasFactory;
    protected $table = 'tb_t_tugas';
    protected $primaryKey = 'id_tu';
    public $timestamps = true;

    protected $fillable = [
        'id_tu',
        'id_mus',
        'id_mt',
        'desk_tj',
        'gmb_tj',
        'file_tj',
    ];

    // Relasi dengan tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_mt', 'id_mt');
    }

    // Relasi dengan user siswa
    public function userSiswa()
    {
        return $this->belongsTo(User::class, 'id_mus', 'id_mus');
    }
}
