<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $table = 'pengunjungs';
    protected $primarykey = 'id_pengunjung';
    protected $fillable = [
    	'nama_pengunjung',
    	'tanggal_kunjungan',
    	'waktu_kunjungan'
    ];
}
