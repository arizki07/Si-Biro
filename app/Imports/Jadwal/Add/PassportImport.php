<?php

namespace App\Imports\Jadwal\Add;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianJadwalModel;
use Carbon\Carbon;

class PassportImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tgl_mulai_passport = $row[1] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]))->toDateString() : null;
        $tgl_selesai_passport = $row[2] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]))->toDateString() : null;
        $jam_mulai_passport = $row[3] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]))->toTimeString() : null;
        $jam_selesai_passport = $row[4] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]))->toTimeString() : null;

        return new UraianJadwalModel([
            'nomor_jadwal' => $row[0],
            'tgl_mulai_passport' => $tgl_mulai_passport,
            'tgl_selesai_passport' => $tgl_selesai_passport,
            'jam_mulai_passport' => $jam_mulai_passport,
            'jam_selesai_passport' => $jam_selesai_passport,
            'tempat_passport' => $row[5],
            'keterangan_passport' => $row[6],
            'judul_passport' => $row[7],
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
