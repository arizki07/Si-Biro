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

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_layanan = '112000' . random_int(10000, 99999);
            while (LayananModel::where('id_layanan', $model->id_layanan)->exists()) {
                $model->id_layanan = '100000' . random_int(10000, 99999);
            }
        });
    }

    protected $keyType = 'int';
    protected $increment = 10;

    public function transaksi()
    {
        return $this->hasMany(TransaksiModel::class, 'id_layanan', 'id_layanan');
    }
}