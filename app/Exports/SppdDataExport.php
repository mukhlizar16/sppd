<?php

namespace App\Exports;

use App\Models\Sppd;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SppdDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $data = Sppd::with('suratTugas', 'uangHarian', 'akomodasi', 'totalPergi', 'totalPulang')->get();
//        dd($data);
        return view('export.sppd', [
            'spdds' => $data,
        ]);
    }
}
