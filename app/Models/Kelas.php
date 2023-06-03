<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'tb_t_class';

    public function periodClass()
    {
        return $this->belongsTo('App\Models\PeriodClass', 'id_tpc', 'id_tpc');
    }

    public function mapels()
    {
        return $this->hasMany('App\Models\Mapel', 'id_tcp', 'id_tc');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_mus', 'id_mus');
    }

    public function userGuru()
    {
        return $this->belongsTo(UserTeacher::class, 'id_mut');
    }

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_tc');
    }
}
