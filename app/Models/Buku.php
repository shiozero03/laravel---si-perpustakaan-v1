<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected $primarykey = 'id_buku';
    protected $fillable = [
        'no_panggil',
        'judul_buku',
        'cover_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'tempat_terbit',
        'halaman',
        'bahasa',
        'sinopsis',
        'status',
        'rating',
        'jumlah_penilai',
        'total_rate',
        'file',
        'sumber'
    ];
}
