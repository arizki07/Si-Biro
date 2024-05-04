<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = 't_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_jamaah',
        'id_layanan',
        'tipe_pembayaran',
        'jumlah_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
        'foto_bukti_pembayaran',
    ];

    public function jamaah()
    {
        return $this->belongsTo(JamaahModel::class, 'id_jamaah', 'id_jamaah');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananModel::class, 'id_layanan', 'id_layanan');
    }
}