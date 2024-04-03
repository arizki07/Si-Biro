<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananModel extends Model
{
    use HasFactory;
    protected $table = 't_layanan';
    protected $primaryKey = 'id_layanan';
    protected $fillable = [
        'judul_layanan',
        'kuota',
        'tahun_pemberangkatan',
        'bulan_pemberangkatan',
        'paket',
        'status_paket',
        'deskripsi',
        'foto_bg'
    ];
}
