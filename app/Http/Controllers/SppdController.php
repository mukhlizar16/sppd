<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSppdRequest;
use App\Models\JenisTugas;
use App\Models\Pegawai;
use App\Models\Sppd;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SppdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Sppd';
        $sppds = Sppd::with('pegawai')->get();
        $jenises = JenisTugas::all();
        $users = Pegawai::all();

        return view('admin.sppd.index')->with(compact('title', 'sppds', 'jenises', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSppdRequest $request)
    {
        $validatedData = $request->validated();

        $sppd = Sppd::create([
            'pegawai_id' => $validatedData['pegawai'],
            'jenis_tugas_id' => $validatedData['jenis_tugas_id'],
            'total_biaya' => $validatedData['total_biaya']
        ]);

        return redirect()->route('surat.index', ['id' => $sppd->id])->with('success', 'Sppd baru berhasil ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        } catch (ValidationException $exception) {
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
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('sppd.index')->with('failed', "Sppd $sppd->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('sppd.index')->with('success', "sppd $sppd->name berhasil dihapus!");
    }
}
