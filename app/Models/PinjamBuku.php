<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamBuku extends Model
{
    use HasFactory;
    protected $table = 'pinjam_bukus';
    protected $primarykey = 'id_pinjam';
    protected $fillable = [
    	'id_member',
    	'id_buku',
    	'tanggal_peminjaman',
    	'jatuh_tempo',
    	'tanggal_dikembalikan',
        'status_pinjam'
    ];
}
