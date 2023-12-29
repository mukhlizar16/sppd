<?php

namespace App\Http\Controllers;

use App\Models\Akomodasi;
use App\Models\Sppd;
use Illuminate\Http\Request;

class AkomodasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Akomodasi';

        return view('admin.sppd.akomodasi.create')->with(compact('title'));
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
                'name_hotel' => 'required',
                'tgl_masuk' => 'required',
                'tgl_keluar' => 'required',
                'no_invoice' => 'required',
                'no_kamar' => 'required',
                'lama_inap' => 'required',
                'nama_kwitansi' => 'required',
                'harga_permalam' => 'required',
                'harga_permalam2' => 'required',
                'total_uang' => 'required',
                'bbm' => 'required',
                'dari' => 'required',
                'ke' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        Akomodasi::create($validatedData);

        return redirect()->route('pergi.index', ['id' => $request->sppd_id])->with('success', 'Akomodasi baru berhasil ditambahkan!');
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
    public function update(Request $request, Akomodasi $akomodasi)
    {
        try {
            $rules = [
                'name_hotel' => 'required',
                'tgl_masuk' => 'required',
                'tgl_keluar' => 'required',
                'no_invoice' => 'required',
                'no_kamar' => 'required',
                'lama_inap' => 'required',
                'nama_kwitansi' => 'required',
                'harga_permalam' => 'required',
                'harga_permalam2' => 'required',
                'total_uang' => 'required',
                'bbm' => 'required',
                'dari' => 'required',
                'ke' => 'required',
            ];

            unset($rules['sppd_id']);

            $validatedData = $this->validate($request, $rules);
            $validatedData['sppd_id'] = $akomodasi->sppd_id;

            Akomodasi::where('id', $akomodasi->id)->update($validatedData);

            return redirect()->back()->with('success', "Data Akomodasi $akomodasi->name_hotel berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akomodasi $akomodasi)
    {
        try {
            Akomodasi::destroy($akomodasi->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Akomodasi $akomodasi->name_hotel tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Akomodasi $akomodasi->name_hotel berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Data Sppd Detail - Akomodasi ';
        if (!$sppd) {
            abort(404); // Or handle the case when the Sppd is not found
        }

        $akomodasis = Akomodasi::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas

        return view('admin.sppd.akomodasi.show', compact('akomodasis', 'title', 'sppd'));
    }

    public function storeDetail(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sppd_id' => 'required',
                'name_hotel' => 'required',
                'tgl_masuk' => 'required',
                'tgl_keluar' => 'required',
                'no_invoice' => 'required',
                'no_kamar' => 'required',
                'lama_inap' => 'required',
                'nama_kwitansi' => 'required',
                'harga_permalam' => 'required',
                'harga_permalam2' => 'required',
                'total_uang' => 'required',
                'bbm' => 'required',
                'dari' => 'required',
                'ke' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        Akomodasi::create($validatedData);

        return redirect()->back()->with('success', 'Akomodasi baru berhasil ditambahkan!');
    }
}
