<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = 'tb_m_period';

    public function periodClasses()
    {
        return $this->hasMany('App\Models\PeriodClass', 'id_mper', 'id_mper');
    }
}
