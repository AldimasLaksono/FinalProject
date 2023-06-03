<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodClass extends Model
{
    use HasFactory;
    protected $table = 'tb_t_period_class';

    public function period()
    {
        return $this->belongsTo('App\Models\Period', 'id_mper', 'id_mper');
    }

    public function class()
    {
        return $this->belongsTo('App\Models\Class', 'id_tpc', 'id_tpc');
    }
}
