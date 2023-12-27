<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $golongans = Golongan::all();
        $title = 'Data Golongan';

        return view('admin.golongan.index')->with(compact('title', 'golongans'));
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
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('golongan.index')->with('failed', $exception->getMessage());
        }

        Golongan::create($validatedData);

        return redirect()->route('golongan.index')->with('success', 'Golongan baru berhasil ditambahkan!');
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
    public function update(Request $request, Golongan $golongan)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
            ];

            $validatedData = $this->validate($request, $rules);

            Golongan::where('id', $golongan->id)->update($validatedData);

            return redirect()->route('golongan.index')->with('success', "Data Golongan $golongan->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('golongan.index')->with('failed', 'Data gagal diperbarui! '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Golongan $golongan)
    {
        try {
            Golongan::destroy($golongan->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('golongan.index')->with('failed', "Golongan $golongan->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('golongan.index')->with('success', "Golongan $golongan->name berhasil dihapus!");
    }
}
