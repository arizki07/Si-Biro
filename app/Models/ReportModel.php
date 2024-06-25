<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    use HasFactory;
    protected $table = 't_report';
    protected $primaryKey = 'id_report';
    protected $fillable = [
        'id_layanan',
        'id_jadwal',
        'id_jamaah',
        'tipe_report',
        'status_report',
        'keterangan',
        'file_opsional'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_report = '331000' . random_int(10000, 99999);
            while (ReportModel::where('id_report', $model->id_report)->exists()) {
                $model->id_report = '331000' . random_int(10000, 99999);
            }
        });
    }

    protected $keyType = 'int';
    protected $increment = 10;

    public function jamaah()
    {
        return $this->belongsTo(JamaahModel::class, 'id_jamaah', 'id_jamaah');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalModel::class, 'id_jadwal', 'id_jadwal');
    }

    public function layanan()
    {
        return $this->belongsTo(LayananModel::class, 'id_layanan', 'id_layanan');
    }
}