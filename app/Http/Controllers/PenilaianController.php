<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::orderBy('nama', 'asc')->get();
        $kriteria = Kriteria::orderBy('kode_kriteria', 'asc')->get();
        
        $penilaian = Penilaian::all();
        $scores = [];
        foreach ($penilaian as $p) {
            $scores[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }

        return view('penilaian.index', compact('alternatif', 'kriteria', 'scores'));
    }

    public function store(Request $request)
    {
        foreach ($request->nilai as $id_alternatif => $kriteria_data) {
            foreach ($kriteria_data as $id_kriteria => $nilai) {
                Penilaian::updateOrCreate(
                    [
                        'id_alternatif' => $id_alternatif,
                        'id_kriteria' => $id_kriteria,
                    ],
                    [
                        'nilai' => $nilai,
                    ]
                );
            }
        }

        return response()->json(['success' => 'Semua nilai berhasil disimpan.']);
    }
}