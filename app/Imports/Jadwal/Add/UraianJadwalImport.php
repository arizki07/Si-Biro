<?php

namespace App\Imports\Jadwal\Add;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianJadwalModel;
use Carbon\Carbon;

class UraianJadwalImport implements ToModel, WithStartRow
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

        $tgl_mulai_bimbingan = $row[6] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]))->toDateString() : null;
        $tgl_selesai_bimbingan = $row[7] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]))->toDateString() : null;
        $jam_mulai_bimbingan = $row[8] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]))->toTimeString() : null;
        $jam_selesai_bimbingan = $row[9] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]))->toTimeString() : null;

        $tgl_mulai_passport = $row[11] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]))->toDateString() : null;
        $tgl_selesai_passport = $row[12] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12]))->toDateString() : null;
        $jam_mulai_passport = $row[13] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]))->toTimeString() : null;
        $jam_selesai_passport = $row[14] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14]))->toTimeString() : null;

        $SESS_ID_JADWAL = Session::get('SESS_ID_JADWAL');

        return new UraianJadwalModel([
            'id_jadwal' => $SESS_ID_JADWAL,
            'nomor_jadwal' => $row[0],
            'tgl_mulai_mcu' => $tgl_mulai_mcu,
            'tgl_selesai_mcu' => $tgl_selesai_mcu,
            'jam_mulai_mcu' => $jam_mulai_mcu,
            'jam_selesai_mcu' => $jam_selesai_mcu,
            'tempat_mcu' => $row[5],
            'tgl_mulai_bimbingan' => $tgl_mulai_bimbingan,
            'tgl_selesai_bimbingan' => $tgl_selesai_bimbingan,
            'jam_mulai_bimbingan' => $jam_mulai_bimbingan,
            'jam_selesai_bimbingan' => $jam_selesai_bimbingan,
            'nama_bimbingan' => $row[10],
            'tgl_mulai_passport' => $tgl_mulai_passport,
            'tgl_selesai_passport' => $tgl_selesai_passport,
            'jam_mulai_passport' => $jam_mulai_passport,
            'jam_selesai_passport' => $jam_selesai_passport,
            'tempat_pembuatan_passport' => $row[15],
            'flag_update' => $row[16],
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
