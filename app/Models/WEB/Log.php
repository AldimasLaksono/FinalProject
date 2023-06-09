<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'tb_log';

    protected $fillable = ['module','action','useraccess'];
}
