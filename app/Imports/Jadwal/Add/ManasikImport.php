<?php

namespace App\Imports\Jadwal\Add;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianJadwalModel;
use Carbon\Carbon;

class ManasikImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tgl_mulai_manasik = $row[1] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]))->toDateString() : null;
        $tgl_selesai_manasik = $row[2] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]))->toDateString() : null;
        $jam_mulai_manasik = $row[3] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]))->toTimeString() : null;
        $jam_selesai_manasik = $row[4] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]))->toTimeString() : null;

        return new UraianJadwalModel([
            'nomor_jadwal' => $row[0],
            'tgl_mulai_manasik' => $tgl_mulai_manasik,
            'tgl_selesai_manasik' => $tgl_selesai_manasik,
            'jam_mulai_manasik' => $jam_mulai_manasik,
            'jam_selesai_manasik' => $jam_selesai_manasik,
            'tempat_manasik' => $row[5],
            'keterangan_manasik' => $row[6],
            'judul_manasik' => $row[7],
        ]);
        // dd ($model); die;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
