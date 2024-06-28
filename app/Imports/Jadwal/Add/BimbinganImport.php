<?php

namespace App\Imports\Jadwal\Add;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianJadwalModel;
use Carbon\Carbon;

class BimbinganImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tgl_mulai_bimbingan = $row[1] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]))->toDateString() : null;
        $tgl_selesai_bimbingan = $row[2] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]))->toDateString() : null;
        $jam_mulai_bimbingan = $row[3] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]))->toTimeString() : null;
        $jam_selesai_bimbingan = $row[4] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]))->toTimeString() : null;

        return new UraianJadwalModel([
            'nomor_jadwal' => $row[0],
            'tgl_mulai_bimbingan' => $tgl_mulai_bimbingan,
            'tgl_selesai_bimbingan' => $tgl_selesai_bimbingan,
            'jam_mulai_bimbingan' => $jam_mulai_bimbingan,
            'jam_selesai_bimbingan' => $jam_selesai_bimbingan,
            'tempat_bimbingan' => $row[5],
            'keterangan_bimbingan' => $row[6],
            'judul_bimbingan' => $row[7],
            'tahap' => $row[8],
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
