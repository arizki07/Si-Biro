<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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

    public function Qmcu()
    {
        $Q = DB::table('t_grup as g')
            ->select('g.*')
            ->join(DB::raw('(SELECT id_layanan, MIN(id_grup) AS min_id_grup 
                            FROM t_grup 
                            GROUP BY id_layanan) AS sub'), function ($join) {
                                $join->on('g.id_layanan', '=', 'sub.id_layanan')
                                    ->on('g.id_grup', '=', 'sub.min_id_grup');
                            })
            ->whereIn('g.id_layanan', function($query) {
                            $query->select('id_layanan')
                                ->from('t_jadwal')
                                ->where('tipe_jadwal', 'MCU');
                        })
            ->get();

        return $Q;
    }

    public function Qbimbingan()
    {
        $Q = DB::table('t_grup as g')
            ->select('g.*')
            ->join(DB::raw('(SELECT id_layanan, MIN(id_grup) AS min_id_grup 
                            FROM t_grup 
                            GROUP BY id_layanan) AS sub'), function ($join) {
                                $join->on('g.id_layanan', '=', 'sub.id_layanan')
                                    ->on('g.id_grup', '=', 'sub.min_id_grup');
                            })
            ->whereIn('g.id_layanan', function($query) {
                            $query->select('id_layanan')
                                ->from('t_jadwal')
                                ->where('tipe_jadwal', 'BIMBINGAN');
                        })
            ->get();

        return $Q;
    }

    public function Qpassport()
    {
        $Q = DB::table('t_grup as g')
            ->select('g.*')
            ->join(DB::raw('(SELECT id_layanan, MIN(id_grup) AS min_id_grup 
                            FROM t_grup 
                            GROUP BY id_layanan) AS sub'), function ($join) {
                                $join->on('g.id_layanan', '=', 'sub.id_layanan')
                                    ->on('g.id_grup', '=', 'sub.min_id_grup');
                            })
            ->whereIn('g.id_layanan', function($query) {
                            $query->select('id_layanan')
                                ->from('t_jadwal')
                                ->where('tipe_jadwal', 'PASSPORT');
                        })
            ->get();

        return $Q;
    }

    public function Qmanasik()
    {
        $Q = DB::table('t_grup as g')
            ->select('g.*')
            ->join(DB::raw('(SELECT id_layanan, MIN(id_grup) AS min_id_grup 
                            FROM t_grup 
                            GROUP BY id_layanan) AS sub'), function ($join) {
                                $join->on('g.id_layanan', '=', 'sub.id_layanan')
                                    ->on('g.id_grup', '=', 'sub.min_id_grup');
                            })
            ->whereIn('g.id_layanan', function($query) {
                            $query->select('id_layanan')
                                ->from('t_jadwal')
                                ->where('tipe_jadwal', 'MANASIK');
                        })
            ->get();

        return $Q;
    }

}
