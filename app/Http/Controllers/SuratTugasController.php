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
        return view('admin.sppd.surat_tugas.create')->with(compact('title', 'pegawais'));
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratTugas $suratTugas)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratTugas $surat)
    {

        try {
            $rules = [
                'nomor_sp2d' => 'required|integer',
                'pegawai_id' => 'required',
                'nomor_st' => 'required|integer',
                'kegiatan' => 'required',
                'lama_tugas' => 'required',
                'tanggal' => 'required',
                'tanggal_berangkat' => 'required',
                'tanggal_kembali' => 'required',
            ];

            unset($rules['sppd_id']);

            $validatedData = $this->validate($request, $rules);
            $validatedData['sppd_id'] = $surat->sppd_id;

            SuratTugas::where('id', $surat->id)->update($validatedData);

            return redirect()->back()->with('success', "Data Surat Tugas $surat->nomor_sp2d berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->back()->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratTugas $surat)
    {
        try {
            SuratTugas::destroy($surat->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Surat Tugas $surat->nomor_sp2d tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Surat Tugas $surat->nomor_sp2d berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Data Sppd Detail - ' . $sppd->name;
        $pegawais = Pegawai::select('id', 'nama')->get();
        if (!$sppd) {
            abort(404); // Or handle the case when the Sppd is not found
        }

        $surats = SuratTugas::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas
        return view('dashboard.sppd.surat_tugas.show', compact('surats', 'title', 'sppd', 'pegawais'));
    }

    public function storeDetail(Request $request)
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

        return redirect()->back()->with('success', 'Surat tugas baru berhasil ditambahkan!');
    }
}
