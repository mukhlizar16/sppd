<?php

namespace App\Http\Controllers;

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
