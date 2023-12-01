<?php

namespace App\Http\Controllers;

use App\Models\JenisTugas;
use App\Models\Sppd;
use App\Models\SuratTugas;
use Illuminate\Http\Request;

class SppdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Sppd';
        $sppds = Sppd::select('id', 'name', 'jenis_tugas_id', 'total_biaya')->get();
        $jenises = JenisTugas::all();
        return view('admin.sppd.index')->with(compact('title', 'sppds', 'jenises'));
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
                'name' => 'required|max:255',
                'jenis_tugas_id' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('sppd.index')->with('failed', $exception->getMessage());
        }

        $sppd = Sppd::create($validatedData);

        return redirect()->route('surat.index', ['id' => $sppd->id])->with('success', 'Sppd baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sppd $sppd)
    {

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
    public function update(Request $request, Sppd $sppd)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
                'jenis_tugas_id' => 'required',
                'total_biaya' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            Sppd::where('id', $sppd->id)->update($validatedData);

            return redirect()->route('sppd.index')->with('success', "Data Sppd $sppd->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('sppd.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sppd $sppd)
    {
        try {
            $sppd = Sppd::whereId($sppd->id)->first();
            $sppd->SuratTugas->each(function ($SuratTugas) {
                $SuratTugas->delete();
              });
            $sppd->Akomodasi->each(function ($Akomodasi) {
                $Akomodasi->delete();
              });
            $sppd->UangHarian->each(function ($UangHarian) {
                $UangHarian->delete();
              });
            $sppd->TotalPergi->each(function ($TotalPergi) {
                $TotalPergi->delete();
              });
            $sppd->TotalPulang->each(function ($TotalPulang) {
                $TotalPulang->delete();
              });
            Sppd::destroy($sppd->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('sppd.index')->with('failed', "Sppd $sppd->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('sppd.index')->with('success', "sppd $sppd->name berhasil dihapus!");
    }

}
