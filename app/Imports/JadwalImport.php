<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\JadwalModel;
use App\Models\LayananModel;
use Carbon\Carbon;

class JadwalImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd ($row); die;
        $tgl_mulai = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]));
        $tgl_selesai = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));

        // $cek = LayananModel::where('id_layanan', $row[0])->exists();

        // if (!$cek) {
        //     throw new \Exception("Nomor Layanan Tidak Ditemukan.");
        // }

        $model = new JadwalModel([
            'id_layanan' => $row[0],
            'nomor_jadwal' => $row[1],
            'judul_jadwal' => $row[2],
            'tipe_jadwal' => $row[3],
            'jangka_waktu' => $row[4],
            'tgl_mulai' => $tgl_mulai->toDateString(),
            'tgl_selesai' => $tgl_selesai->toDateString(),
        ]);
        // dd ($model); die;
        $model->save();

        Session::put('SESS_ID_JADWAL', $model->id_jadwal);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
