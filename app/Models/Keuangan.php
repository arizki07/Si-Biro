<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 't_keuangan';
    protected $primaryKey = 'id_keuangan';
    protected $fillable = [
        'id_jamaah',
        'id_transaksi',
        'pembayaran',
        'tipe_keuangan',
        'periode',
    ];

    public function jamaah()
    {
        return $this->belongsTo(JamaahModel::class, 'id_jamaah');
    }

    /**
     * Get the transaksi that owns the keuangan.
     */
    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi');
    }
}
