<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use App\Models\SuratTugas;
use App\Models\UangHarian;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UangHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Uang Harian';

        return view('admin.sppd.uang_harian.create')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $st = SuratTugas::where('sppd_id', $request->sppd_id)->first();
        
        try {
            $validatedData = $request->validate([
                'sppd_id' => 'required',
                'harian' => 'required',
                'konsumsi' => 'required',
                'transportasi' => 'required',
                'representasi' => 'required',
            ]);
            $validatedData['total_harian'] = $request->harian * $st->lama_tugas;
            $validatedData['total_konsumsi'] = $request->konsumsi * $st->lama_tugas;
            $validatedData['total_transportasi'] = $request->transportasi * $st->lama_tugas;
            $validatedData['total_representasi'] = $request->representasi * $st->lama_tugas;
        } catch (ValidationException $exception) {
            return back()->with('failed', $exception->getMessage());
        }

        UangHarian::create($validatedData);

        return redirect()->route('akomodasi.index', ['id' => $request->sppd_id])->with('success', 'Uang Harian baru berhasil ditambahkan!');
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
    public function update(Request $request, UangHarian $uang)
    {
        try {
            $rules = [
                'harian' => 'required',
                'konsumsi' => 'required',
                'transportasi' => 'required',
                'representasi' => 'required',
            ];

            unset($rules['sppd_id']);

            $validatedData = $this->validate($request, $rules);
            $validatedData['sppd_id'] = $uang->sppd_id;

            UangHarian::where('id', $uang->id)->update($validatedData);

            return redirect()->back()->with('success', "Data Uang Harian $uang->harian berhasil diperbarui!");
        } catch (ValidationException $exception) {
            return redirect()->back()->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UangHarian $uang)
    {
        try {
            UangHarian::destroy($uang->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Uang Harian $uang->asal tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Uang Harian $uang->asal berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Data Sppd Detail - Uang Harian ';
        if (!$sppd) {
            abort(404); // Or handle the case when the Sppd is not found
        }

        $uangs = UangHarian::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas

        return view('admin.sppd.uang_harian.show', compact('uangs', 'title', 'sppd'));
    }

    public function storeDetail(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sppd_id' => 'required',
                'harian' => 'required',
                'konsumsi' => 'required',
                'transportasi' => 'required',
                'representasi' => 'required',
            ]);
        } catch (ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        UangHarian::create($validatedData);

        return redirect()->back()->with('success', 'Uang Harian baru berhasil ditambahkan!');
    }
}
