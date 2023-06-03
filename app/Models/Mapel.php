<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'tb_m_mapel';

    public function mapelClasses()
    {
        return $this->hasMany(MapelClass::class, 'id_mm', 'id_mm');
    }

    public function materi()
    {
        return $this->hasManyThrough(Materi::class, MapelClass::class, 'id_mm', 'id_tm');
    }
}
