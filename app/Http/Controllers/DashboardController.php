<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk card ringkasan
        $jumlah_kriteria = Kriteria::count();
        $jumlah_alternatif = Alternatif::count();

        // Panggil PerhitunganController untuk mengambil hasil
        $perhitunganController = new PerhitunganController();

        // Ambil data Peringkat 5 Teratas SAW
        $hasil_saw_data = $perhitunganController->saw()->getData();
        $peringkat_saw = [];
        if (isset($hasil_saw_data['nilai_v'])) {
            $top_saw = array_slice($hasil_saw_data['nilai_v'], 0, 5, true);
            $alternatif_collection = $hasil_saw_data['alternatif'];
            $rank = 1;
            foreach($top_saw as $id => $nilai) {
                $peringkat_saw[] = [
                    'rank' => $rank++,
                    'nama' => $alternatif_collection->find($id)->nama,
                    'nilai' => $nilai
                ];
            }
        }

        // Ambil data Peringkat 5 Teratas ARAS
        $hasil_aras_data = $perhitunganController->aras()->getData();
        $peringkat_aras = [];
        if (isset($hasil_aras_data['tingkat_utilitas_k'])) {
            $top_aras = array_slice($hasil_aras_data['tingkat_utilitas_k'], 0, 5, true);
            $alternatif_collection = $hasil_aras_data['alternatif'];
            $rank = 1;
            foreach($top_aras as $id => $nilai) {
                $peringkat_aras[] = [
                    'rank' => $rank++,
                    'nama' => $alternatif_collection->find($id)->nama,
                    'nilai' => $nilai
                ];
            }
        }

        return view('dashboard', compact(
            'jumlah_kriteria',
            'jumlah_alternatif',
            'peringkat_saw',
            'peringkat_aras'
        ));
    }
}
