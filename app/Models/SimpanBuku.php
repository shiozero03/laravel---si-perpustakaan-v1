<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpanBuku extends Model
{
    use HasFactory;
    protected $table = 'simpan_bukus';
    protected $primarykey = 'id_simpan';
    protected $fillable = [
    	'id_member',
    	'id_buku',
    	'tanggal_simpan'
    ];
}
