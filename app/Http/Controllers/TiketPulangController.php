<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use App\Models\TotalPulang;
use Illuminate\Http\Request;

class TiketPulangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Tiket Pulang';
        return view('admin.sppd.total_pulang.create')->with(compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sppd_id' => 'required',
                'asal' => 'required',
                'tujuan' => 'required',
                'tgl_penerbangan' => 'required',
                'maskapai' => 'required',
                'booking_reference' => 'required',
                'no_eticket' => 'required',
                'no_penerbangan' => 'required',
                'total_harga' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        TotalPulang::create($validatedData);

        return redirect()->route('sppd.index')->with('success', 'Sppd baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TotalPulang $pulang)
    {
        try {
            $rules = [
                'asal' => 'required',
                'tujuan' => 'required',
                'tgl_penerbangan' => 'required',
                'maskapai' => 'required',
                'booking_reference' => 'required',
                'no_eticket' => 'required',
                'no_penerbangan' => 'required',
                'total_harga' => 'required',
            ];

            unset($rules['sppd_id']);

            $validatedData = $this->validate($request, $rules);
            $validatedData['sppd_id'] = $pulang->sppd_id;

            TotalPulang::where('id', $pulang->id)->update($validatedData);

            return redirect()->back()->with('success', "Data Tiket Pulang $pulang->asal berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalPulang $pulang)
    {
        try {
            TotalPulang::destroy($pulang->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Tiket Pulang $pulang->asal tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Tiket Pulang $pulang->asal berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Data Sppd Detail - ' . $sppd->name;
        if (!$sppd) {
            abort(404); // Or handle the case when the Sppd is not found
        }

        $pulangs = TotalPulang::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas
        return view('dashboard.sppd.total_pulang.show', compact('pulangs', 'title', 'sppd'));
    }

    public function storeDetail(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sppd_id' => 'required',
                'asal' => 'required',
                'tujuan' => 'required',
                'tgl_penerbangan' => 'required',
                'maskapai' => 'required',
                'booking_reference' => 'required',
                'no_eticket' => 'required',
                'no_penerbangan' => 'required',
                'total_harga' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        TotalPulang::create($validatedData);

        return redirect()->back()->with('success', 'Tiket Pulang baru berhasil ditambahkan!');
    }
}
