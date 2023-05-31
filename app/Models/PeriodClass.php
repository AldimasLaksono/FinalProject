<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodClass extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_t_period_class';
    protected $primaryKey = 'id_tpc';

    protected $fillable = ['id_mper','name_tpc','description_tpc'];
}
