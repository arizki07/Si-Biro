<?php

namespace App\Imports\Jadwal\Add;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianJadwalModel;
use Carbon\Carbon;

class McuImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tgl_mulai_mcu = $row[1] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]))->toDateString() : null;
        $tgl_selesai_mcu = $row[2] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]))->toDateString() : null;
        $jam_mulai_mcu = $row[3] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]))->toTimeString() : null;
        $jam_selesai_mcu = $row[4] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]))->toTimeString() : null;

        return new UraianJadwalModel([
            'nomor_jadwal' => $row[0],
            'tgl_mulai_mcu' => $tgl_mulai_mcu,
            'tgl_selesai_mcu' => $tgl_selesai_mcu,
            'jam_mulai_mcu' => $jam_mulai_mcu,
            'jam_selesai_mcu' => $jam_selesai_mcu,
            'tempat_mcu' => $row[5],
            'keterangan_mcu' => $row[6],
            'judul_mcu' => $row[7],
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
