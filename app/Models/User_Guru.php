<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class User_Guru extends Model
{
    use HasFactory;

    //definiskan tabel secara manual
    protected $table = 'tb_m_user_teacher';
    protected $primaryKey = 'id_mut';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_mut',
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

    public function jabatan()
    {
        return $this->belongsTo(tb_m_jabatan::class, 'id_mja');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Crypt::encryptString($password);
    }
}
