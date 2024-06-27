<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalModel extends Model
{
    use HasFactory;
    protected $table = 't_jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'id_layanan',
        'nomor_jadwal',
        'judul_jadwal',
        'tipe_jadwal',
        'tgl_mulai',
        'tgl_selesai'
    ];
}
