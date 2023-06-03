<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTeacher extends Model
{
    use HasFactory;
    protected $table = 'tb_m_user_teacher';
    protected $primaryKey = 'id_mut';
    public $timestamps = true;

    protected $fillable = [
        'id_mja',
        'nip',
        'name_mut',
        'ttl_mut',
        'gender_mut',
        'alamat_mut',
        'notelp_mut',
        'email',
        'status_mut',
        'foto_mut',
        'role_mut',
        'password',
        'status',
    ];
}
