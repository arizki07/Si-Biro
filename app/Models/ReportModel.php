<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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
        'id_uraian_jadwal',
        'id_jamaah',
        'tahap',
        'tipe_report',
        'status_report',
        'keterangan',
        'file_opsional'
    ];

    // >>>>>>>>>>>>>>>>>>>>>>>>> PENTING! JANGAN DIHAPUS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    // public function QueryReport()
    // {
    //     $Q = DB::table('t_report as a')
    //         ->join('t_jamaah as b', 'a.id_jamaah', '=', 'b.id_jamaah')
    //         ->join('t_layanan as c', 'a.id_layanan', '=', 'c.id_layanan')
    //         ->join('t_jadwal as d', 'a.id_jadwal', '=', 'd.id_jadwal')
    //         // ->join('t_uraian_jadwal as e', 'd.nomor_jadwal', '=', 'e.nomor_jadwal')
    //         ->join('t_uraian_jadwal as e', function($join) {
    //             $join->on('d.nomor_jadwal', '=', 'e.nomor_jadwal')
    //                  ->on('a.tahap', '=', 'e.tahap');
    //         })
    //         ->select('a.*', 'c.*', 'b.*', 'd.*', 'a.tahap as tahap_report', 'e.*')
    //         ->orderBy('a.tipe_report', 'ASC')
    //         ->orderBy('a.tahap', 'ASC')
    //         // ->groupBy('e.id_uraian_jadwal')
    //         // ->first();
    //         ->get();

    //     return $Q;
    // }

    public function QueryReport()
    {
        $Q = DB::table('t_report as a')
            ->join('t_jamaah as b', 'a.id_jamaah', '=', 'b.id_jamaah')
            ->join('t_layanan as c', 'a.id_layanan', '=', 'c.id_layanan')
            ->join('t_jadwal as d', 'a.id_jadwal', '=', 'd.id_jadwal')
            ->join('t_uraian_jadwal as e', function($join) {
                $join->on('d.nomor_jadwal', '=', 'e.nomor_jadwal')
                    ->on('a.tahap', '=', 'e.tahap');
            })
            ->select('a.*', 'c.*', 'b.*', 'd.*', 'a.tahap as tahap_report', 'e.*')
            ->whereIn('a.id_report', function ($query) {
                $query->select(DB::raw('MIN(a.id_report)'))
                    ->from('t_report as a')
                    ->groupBy('a.id_jamaah');
            })
            ->orderBy('a.tipe_report', 'ASC')
            ->orderBy('a.tahap', 'ASC')
            ->get();

        return $Q;
    }


    public function QueryReportByID($id)
    {
        $Query = DB::table('t_report as a')
            ->join('t_jamaah as b', 'a.id_jamaah', '=', 'b.id_jamaah')
            ->join('users as f', 'f.id_user', '=', 'b.id_user')
            ->join('t_layanan as c', 'a.id_layanan', '=', 'c.id_layanan')
            ->join('t_jadwal as d', 'a.id_jadwal', '=', 'd.id_jadwal')
            ->join('t_transaksi as g', 'g.id_jamaah', '=', 'b.id_jamaah')
            ->join('t_uraian_jadwal as e', function($join) {
                $join->on('d.nomor_jadwal', '=', 'e.nomor_jadwal')
                     ->on('a.tahap', '=', 'e.tahap');
            })
            ->select('a.*', 'c.*', 'b.*', 'd.*', 'e.*', 'f.*', 'g.*',
             'a.tahap as tahap_report',
             'e.tahap as tahap_uraian_jadwal',
             'b.created_at as created_jamaah',
             'b.verifikasi as verif_jamaah',
             'g.verifikasi as verif_transaksi',
             'c.id_layanan as nomor_layanan',
             'b.id_jamaah as nomor_jamaah',
             'e.created_at as tanggal_report',
             )
            ->where('a.id_report', '=', $id)
            ->first();
        // dd ($Query);
        return $Query;
    }

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