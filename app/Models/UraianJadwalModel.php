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
        'nomor_jadwal',
        'tahap',

        // MCU
        'judul_mcu',
        'tgl_mulai_mcu',
        'tgl_selesai_mcu',
        'jam_mulai_mcu',
        'jam_selesai_mcu',
        'tempat_mcu',
        'keterangan_mcu',
        'file_mcu',
        
        // BIMBINGAN
        'judul_bimbingan',
        'tgl_mulai_bimbingan',
        'tgl_selesai_bimbingan',
        'jam_mulai_bimbingan',
        'jam_selesai_bimbingan',
        'tempat_bimbingan',
        'keterangan_bimbingan',
        'file_bimbingan',

        // PASSPORT
        'judul_passport',
        'tgl_mulai_passport',
        'tgl_selesai_passport',
        'jam_mulai_passport',
        'jam_selesai_passport',
        'tempat_passport',
        'keterangan_passport',
        'file_passport',

        // MANASIK
        'judul_manasik',
        'tgl_mulai_manasik',
        'tgl_selesai_manasik',
        'jam_mulai_manasik',
        'jam_selesai_manasik',
        'tempat_manasik',
        'keterangan_manasik',
        'file_manasik',
    ];
}
