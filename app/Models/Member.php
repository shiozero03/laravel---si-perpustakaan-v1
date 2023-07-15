<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $primarykey = 'id_member';
    protected $fillable = [
    	'nisn',
    	'nama',
        'password',
    	'jenis_kelamin',
    	'tanggal_lahir',
    	'no_hp',
    	'alamat',
    	'pekerjaan',
    	'foto_profil',
    	'role',
    	'deleted_at',
    	'created_at',
    	'updated_at'
    ];
}
