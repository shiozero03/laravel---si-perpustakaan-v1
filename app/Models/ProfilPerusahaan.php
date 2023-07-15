<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'profil_perusahaans';
    protected $primarykey = 'id_profil_perusahaan';
    protected $fillable = [
    	'kategori',
    	'teks'
    ];
}
