<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TClass extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_t_class';
    protected $primaryKey = 'id_tc';

    protected $fillable = ['id_tc','id_tpc','id_mr','name_tc'];
}
