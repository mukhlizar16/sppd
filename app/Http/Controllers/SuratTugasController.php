<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Sppd;
use App\Models\SuratTugas;
use Illuminate\Http\Request;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Surat';
        $pegawais = Pegawai::select('id', 'nama')->get();
        return view('dashboard.sppd.surat_tugas.create')->with(compact('title', 'pegawais'));
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
                'nomor_sp2d' => 'required',
                'pegawai_id' => 'required',
                'nomor_st' => 'required',
                'kegiatan' => 'required',
                'lama_tugas' => 'required',
                'tanggal' => 'required',
                'tanggal_berangkat' => 'required',
                'tanggal_kembali' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        SuratTugas::create($validatedData);

        return redirect()->route('uang.index', ['id' => $request->sppd_id])->with('success', 'Surat tugas baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratTugas $suratTugas)
    {
        $sppd = Sppd::where('id', $suratTugas->sppd_id)->get();
        $title = 'Data Sppd Detail - ' . $sppd->name;
        $surats = SuratTugas::where('sppd_id', $sppd->id)->get();
        return view('dashboard.sppd.show')->with(compact('title', 'sppd', 'surats'));
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

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Data Sppd Detail - ' . $sppd->name;

        if (!$sppd) {
            abort(404); // Or handle the case when the Sppd is not found
        }

        $surats = SuratTugas::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas
        return view('dashboard.sppd.surat_tugas.show', compact('surats', 'title', 'sppd'));
    }
}
