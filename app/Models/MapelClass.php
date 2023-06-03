<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapelClass extends Model
{
    use HasFactory;
    protected $table = 'tb_t_mapel';

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'id_tc', 'id_tc');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'id_mut', 'id_mper');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mm', 'id_mm');
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_tm', 'id_tm');
    }
}
