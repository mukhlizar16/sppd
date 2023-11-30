<?php

namespace App\Http\Controllers;

use App\Models\TotalPergi;
use Illuminate\Http\Request;

class TiketPergiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Tiket Pergi';
        return view('dashboard.sppd.total_pergi.create')->with(compact('title'));
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

        TotalPergi::create($validatedData);

        return redirect()->route('pulang.index', ['id' => $request->sppd_id])->with('success', 'Tiket Pergi baru berhasil ditambahkan!');
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
