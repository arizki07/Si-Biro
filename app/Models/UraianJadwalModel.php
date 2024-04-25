<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianJadwalModel extends Model
{
    use HasFactory;
    protected $table = 't_uraian_jadwal';
    protected $primaryKey = 'id_uraian_jadwal';
    protected $fillable = [
        'id_jadwal',
        'nomor_jadwal',
        'tgl_mulai_mcu',
        'tgl_selesai_mcu',
        'jam_mulai_mcu',
        'jam_selesai_mcu',
        'tempat_mcu',
        'tgl_mulai_passport',
        'tgl_selesai_passport',
        'jam_mulai_passport',
        'jam_selesai_passport',
        'nama_bimbingan',
        'tgl_mulai_bimbingan',
        'tgl_selesai_bimbingan',
        'jam_mulai_bimbingan',
        'jam_selesai_bimbingan',
        'tempat_pembuatan_passport',
        'flag_update',
        'tipe'
    ];
}
