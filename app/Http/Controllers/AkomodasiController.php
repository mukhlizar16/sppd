<?php

namespace App\Http\Controllers;

use App\Models\Akomodasi;
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
