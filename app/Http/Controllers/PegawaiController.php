<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Golongan;
use App\Models\Pegawai;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Pegawai';
        $pegawais = Pegawai::with('jenisAsn', 'Golongan')->get();

        return view('admin.pegawai.index')->with(compact('title', 'pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                'jenis_asn_id' => 'required',
                'nip' => 'required',
                'golongan_id' => 'required',
                'jabatan' => 'required',
                'instansi' => 'required',
            ]);

            $existingUser = User::where('username', $validatedData['nip'])->first();
            if ($existingUser) {
                throw new Exception('NIP baru sudah digunakan.');
            }

            $userData = [
                'name' => $validatedData['nama'],
                'username' => $validatedData['nip'],
                'email' => $validatedData['nama'].'@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($validatedData['nip']),
                'isAdmin' => 0,
            ];

            User::create($userData);

            $validatedData['user_id'] = User::where('username', $validatedData['nip'])->first(['id'])->id;
            Pegawai::create($validatedData);

            return redirect('/dashboard/pegawai')->with('success', 'Pegawai baru berhasil dibuat!');
        } catch (ValidationException $e) {
            return redirect('/dashboard/pegawai/create')->with('failed', $e->getMessage())->withInput();
        } catch (Exception $e) {
            return redirect('/dashboard/pegawai/create')->with('failed', $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asns = Asn::all();
        $golongans = Golongan::all();

        return view('admin.pegawai.create', [
            'title' => 'Tambah Pegawai Baru',
        ])->with(compact('asns', 'golongans'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        $asns = Asn::all();
        $golongans = Golongan::all();

        return view('admin.pegawai.view', [
            'title' => 'Info Pegawai',
        ])->with(compact('asns', 'golongans', 'pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $asns = Asn::all();
        $golongans = Golongan::all();

        return view('admin.pegawai.edit', [
            'title' => 'Update Pegawai Baru',
        ])->with(compact('asns', 'golongans', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                'jenis_asn_id' => 'required',
                'nip' => 'required',
                'golongan_id' => 'required',
                'jabatan' => 'required',
                'instansi' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('pegawai.edit', ['pegawai' => $pegawai->id])->with('failed', $e->getMessage());
        }

        Pegawai::where('id', $pegawai->id)->update($validatedData);

        return redirect('/dashboard/pegawai')->with('success', 'Data Pegawai berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        try {
            Pegawai::destroy($pegawai->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('pegawai.index')->with('failed', "Pegawai $pegawai->nama tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('pegawai.index')->with('success', "Pegawai $pegawai->nama berhasil dihapus!");
    }
}
