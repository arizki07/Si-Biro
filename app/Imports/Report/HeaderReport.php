<?php

namespace App\Imports\Report;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\Importable;
// use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithStartRow;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HeaderReport implements WithMultipleSheets
{
    public function sheets(): array
    {
        // echo "Wle"; die;
        return [
            'REPORT MCU' => new McuReport(),
            'REPORT BIMBINGAN' => new BimbinganReport(),
            'REPORT PASSPORT' => new PassportReport(),
            'REPORT MANASIK' => new ManasikReport()
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} di skip :p");
    }
}
