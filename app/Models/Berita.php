<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas';
    protected $primarykey = 'id_berita';
    protected $fillable = [
		'feature_image',
		'judul_berita',
		'tanggal_berita',
		'author',
		'isi_berita',
    ];
}
