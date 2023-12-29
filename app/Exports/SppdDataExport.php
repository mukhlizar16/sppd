<?php

namespace App\Exports;

use App\Models\Akomodasi;
use App\Models\Sppd;
use App\Models\SuratTugas;
use App\Models\TotalPergi;
use App\Models\TotalPulang;
use App\Models\UangHarian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SppdDataExport implements FromView,ShouldAutoSize
{
    use Exportable;

    private $sppdId, $sppd;

    public function __construct($sppdId)
    {
        $this->sppdId = $sppdId;
        $this->sppd = Sppd::findOrFail($sppdId)->with('SuratTugas', 'UangHarian', 'Akomodasi', 'TotalPergi', 'TotalPulang')->get();
    }
    public function view() : View
    {
        return view('export.sppd', [
            'spdds' => $this->sppd,
        ]);
    }
}
