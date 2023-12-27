<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use Illuminate\Http\Request;

class AsnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asns = Asn::all();
        $title = 'Data Asn';

        return view('admin.asn.index')->with(compact('title', 'asns'));
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
            return redirect()->route('asn.index')->with('failed', $exception->getMessage());
        }

        Asn::create($validatedData);

        return redirect()->route('asn.index')->with('success', 'Asn baru berhasil ditambahkan!');
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
    public function update(Request $request, Asn $asn)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
            ];

            $validatedData = $this->validate($request, $rules);

            Asn::where('id', $asn->id)->update($validatedData);

            return redirect()->route('asn.index')->with('success', "Data Asn $asn->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('asn.index')->with('failed', 'Data gagal diperbarui! '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asn $asn)
    {
        try {
            Asn::destroy($asn->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('asn.index')->with('failed', "Asn $asn->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('asn.index')->with('success', "Asn $asn->name berhasil dihapus!");
    }
}
