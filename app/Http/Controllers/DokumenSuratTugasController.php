<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenSuratTugasController extends Controller
{
    public function index()
    {
        $title = 'Dokumen Surat Tugas';

        return view('admin.dokumen.surat_tugas.index', compact('title'));

    }
}
