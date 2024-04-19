<?php

namespace App\Imports\Jadwal\Update;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HeaderUpdateImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'JADWAL' => new JadwalUpdateImport()
            // 'URAIAN JADWAL' => new UraianJadwalUpdateImport()
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} di skip :p");
    }
}
