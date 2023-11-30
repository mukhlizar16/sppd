<?php

namespace App\Http\Controllers;

use App\Models\UangHarian;
use Illuminate\Http\Request;

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
                'harian' => 'required',
                'total_harian' => 'required',
                'konsumsi' => 'required',
                'total_konsumsi' => 'required',
                'transportasi' => 'required',
                'total_transportasi' => 'required',
                'representasi' => 'required',
                'total_representasi' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        UangHarian::create($validatedData);

        return redirect()->route('akomodasi.index', ['id' => $request->sppd_id])->with('success', 'Uang Harian baru berhasil ditambahkan!');
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
