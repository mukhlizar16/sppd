<?php

namespace App\Http\Controllers;

use App\Models\JenisTugas;
use Illuminate\Http\Request;

class JenisTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Jenis Tugas';
        $jenises = JenisTugas::all();
        return view('admin.jenis-tugas.index')->with(compact('title', 'jenises'));
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
            return redirect()->route('jenis.index')->with('failed', $exception->getMessage());
        }

        JenisTugas::create($validatedData);

        return redirect()->route('jenis.index')->with('success', 'Jenis Tugas baru berhasil ditambahkan!');
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
    public function update(Request $request, JenisTugas $jeni)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
            ];

            $validatedData = $this->validate($request, $rules);

            JenisTugas::where('id', $jeni->id)->update($validatedData);

            return redirect()->route('jenis.index')->with('success', "Data Jenis Tugas $jeni->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('jenis.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisTugas $jeni)
    {
        try {
            JenisTugas::destroy($jeni->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('jenis.index')->with('failed', "Jenis Tugas $jeni->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('jenis.index')->with('success', "Jenis Tugas $jeni->name berhasil dihapus!");
    }
}
