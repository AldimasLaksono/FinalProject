<?php

namespace App\Models;

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

    // Relasi dengan kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_tc', 'id_tc');
    }

    // Relasi dengan user guru
    public function userGuru()
    {
        return $this->belongsTo(User::class, 'id_mut', 'id_mut');
    }
}
