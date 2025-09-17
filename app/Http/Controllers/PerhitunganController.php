<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    /**
     * Menampilkan halaman hasil akhir, perbandingan, dan korelasi spearman.
     */
    public function hasil()
    {
        $alternatif = Alternatif::orderBy('nama', 'asc')->get();
        if ($alternatif->isEmpty()) {
            return view('hasil.index')->with('error', 'Data Alternatif belum ada.');
        }

        // Panggil helper private untuk mendapatkan hasil akhir dari kedua metode
        $hasil_saw = $this->hitungSaw()['nilai_v'];
        $hasil_aras = $this->hitungAras()['tingkat_utilitas_k'];

        // Siapkan data peringkat untuk korelasi
        $peringkat_saw = [];
        $rank = 1;
        foreach ($hasil_saw as $id => $nilai) {
            $peringkat_saw[$id] = $rank++;
        }

        $peringkat_aras = [];
        $rank = 1;
        foreach ($hasil_aras as $id => $nilai) {
            $peringkat_aras[$id] = $rank++;
        }

        // Hitung Korelasi Spearman
        $total_d2 = 0;
        $spearman_details = [];
        foreach ($alternatif as $alt) {
            $rank_saw = $peringkat_saw[$alt->id] ?? 0;
            $rank_aras = $peringkat_aras[$alt->id] ?? 0;
            $d = $rank_saw - $rank_aras;
            $d2 = pow($d, 2);
            $total_d2 += $d2;

            $spearman_details[] = [
                'nama' => $alt->nama,
                'rank_saw' => $rank_saw,
                'rank_aras' => $rank_aras,
                'd' => $d,
                'd2' => $d2,
            ];
        }

        $n = count($alternatif);
        $rho = 0;
        $interpretasi = "Tidak dapat dihitung";
        if ($n > 1) {
            $penyebut = $n * (pow($n, 2) - 1);
            $rho = ($penyebut != 0) ? 1 - ((6 * $total_d2) / $penyebut) : 0;

            $abs_rho = abs($rho);
            if ($abs_rho >= 0.8)
                $interpretasi = "Korelasi Sangat Kuat";
            elseif ($abs_rho >= 0.6)
                $interpretasi = "Korelasi Kuat";
            elseif ($abs_rho >= 0.4)
                $interpretasi = "Korelasi Cukup";
            elseif ($abs_rho >= 0.2)
                $interpretasi = "Korelasi Lemah";
            else
                $interpretasi = "Korelasi Sangat Lemah";
        }

        return view('hasil.index', compact(
            'alternatif',
            'hasil_saw',
            'hasil_aras',
            'spearman_details',
            'total_d2',
            'n',
            'rho',
            'interpretasi'
        ));
    }

    /**
     * Menampilkan halaman detail perhitungan SAW.
     */
    public function saw()
    {
        $data = $this->hitungSaw();
        return view('perhitungan.saw', $data);
    }

    /**
     * Menampilkan halaman detail perhitungan ARAS.
     */
    public function aras()
    {
        $data = $this->hitungAras();
        return view('perhitungan.aras', $data);
    }

    // =================================================================
    // PRIVATE HELPER METHODS
    // =================================================================

    private function hitungSaw()
    {
        $kriteria = Kriteria::orderBy('kode_kriteria', 'asc')->get();
        $alternatif = Alternatif::orderBy('nama', 'asc')->get();

        if ($kriteria->isEmpty() || $alternatif->isEmpty()) {
            return ['error' => 'Data Kriteria atau Alternatif belum lengkap.'];
        }

        $semua_penilaian = Penilaian::all();
        $matriks_x = [];
        foreach ($semua_penilaian as $p) {
            $matriks_x[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }
        foreach ($alternatif as $alt) {
            foreach ($kriteria as $k) {
                if (!isset($matriks_x[$alt->id][$k->id])) {
                    $matriks_x[$alt->id][$k->id] = 0;
                }
            }
        }

        $matriks_r = [];
        $minMax = [];
        foreach ($kriteria as $k) {
            $kolom_nilai = array_column($matriks_x, $k->id);
            $minMax[$k->id]['min'] = !empty($kolom_nilai) ? min($kolom_nilai) : 0;
            $minMax[$k->id]['max'] = !empty($kolom_nilai) ? max($kolom_nilai) : 0;
        }

        foreach ($matriks_x as $id_alternatif => $kriteria_data) {
            foreach ($kriteria_data as $id_kriteria => $nilai) {
                $k = $kriteria->find($id_kriteria);
                $max = $minMax[$id_kriteria]['max'];
                $min = $minMax[$id_kriteria]['min'];
                if ($k->jenis == 'benefit') {
                    $matriks_r[$id_alternatif][$id_kriteria] = ($max != 0) ? $nilai / $max : 0;
                } else {
                    $matriks_r[$id_alternatif][$id_kriteria] = ($nilai != 0) ? $min / $nilai : 0;
                }
            }
        }

        $bobot_w = $kriteria->pluck('bobot', 'id')->all();
        $matriks_terbobot = [];
        foreach ($matriks_r as $id_alternatif => $kriteria_data) {
            foreach ($kriteria_data as $id_kriteria => $nilai) {
                $matriks_terbobot[$id_alternatif][$id_kriteria] = $nilai * $bobot_w[$id_kriteria];
            }
        }

        $nilai_v = [];
        foreach ($matriks_terbobot as $id_alternatif => $kriteria_data) {
            $nilai_v[$id_alternatif] = array_sum($kriteria_data);
        }

        arsort($nilai_v);

        return compact('kriteria', 'alternatif', 'matriks_x', 'matriks_r', 'minMax', 'bobot_w', 'matriks_terbobot', 'nilai_v');
    }

    private function hitungAras()
    {
        $kriteria = Kriteria::orderBy('kode_kriteria', 'asc')->get();
        $alternatif = Alternatif::orderBy('nama', 'asc')->get();

        if ($kriteria->isEmpty() || $alternatif->isEmpty()) {
            return ['error' => 'Data Kriteria atau Alternatif belum lengkap.'];
        }

        $semua_penilaian = Penilaian::all();
        $matriks_x = [];
        foreach ($semua_penilaian as $p) {
            $matriks_x[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }
        foreach ($alternatif as $alt) {
            foreach ($kriteria as $k) {
                if (!isset($matriks_x[$alt->id][$k->id])) {
                    $matriks_x[$alt->id][$k->id] = 0;
                }
            }
        }

        $matriks_x_transformed = [];
        foreach ($matriks_x as $id_alternatif => $kriteria_data) {
            foreach ($kriteria_data as $id_kriteria => $nilai) {
                $k = $kriteria->find($id_kriteria);
                if ($k->jenis == 'cost') {
                    $matriks_x_transformed[$id_alternatif][$id_kriteria] = ($nilai != 0) ? 1 / $nilai : 0;
                } else {
                    $matriks_x_transformed[$id_alternatif][$id_kriteria] = $nilai;
                }
            }
        }

        $matriks_x0 = [];
        foreach ($kriteria as $k) {
            $kolom_nilai = array_column($matriks_x_transformed, $k->id);
            $matriks_x0[$k->id] = !empty($kolom_nilai) ? max($kolom_nilai) : 0;
        }

        $matriks_extended_x = $matriks_x_transformed;
        $matriks_extended_x[0] = $matriks_x0;

        $jumlah_kolom_x = [];
        foreach ($kriteria as $k) {
            $jumlah_kolom_x[$k->id] = array_sum(array_column($matriks_extended_x, $k->id));
        }

        $matriks_r = [];
        foreach ($matriks_x_transformed as $id_alternatif => $kriteria_data) {
            foreach ($kriteria_data as $id_kriteria => $nilai) {
                $jumlah = $jumlah_kolom_x[$id_kriteria];
                $matriks_r[$id_alternatif][$id_kriteria] = ($jumlah != 0) ? $nilai / $jumlah : 0;
            }
        }

        $bobot_w = $kriteria->pluck('bobot', 'id')->all();
        $matriks_terbobot = [];
        foreach ($matriks_r as $id_alternatif => $kriteria_data) {
            foreach ($kriteria_data as $id_kriteria => $nilai) {
                $matriks_terbobot[$id_alternatif][$id_kriteria] = $nilai * $bobot_w[$id_kriteria];
            }
        }

        $nilai_s = [];
        foreach ($matriks_terbobot as $id_alternatif => $kriteria_data) {
            $nilai_s[$id_alternatif] = array_sum($kriteria_data);
        }

        $s0_terbobot = [];
        foreach ($kriteria as $k) {
            $jumlah = $jumlah_kolom_x[$k->id];
            $normalisasi_x0 = ($jumlah != 0) ? $matriks_x0[$k->id] / $jumlah : 0;
            $s0_terbobot[$k->id] = $normalisasi_x0 * $bobot_w[$k->id];
        }
        $nilai_s0 = array_sum($s0_terbobot);

        $tingkat_utilitas_k = [];
        foreach ($nilai_s as $id_alternatif => $nilai) {
            $tingkat_utilitas_k[$id_alternatif] = ($nilai_s0 != 0) ? $nilai / $nilai_s0 : 0;
        }

        arsort($tingkat_utilitas_k);

        return compact('kriteria', 'alternatif', 'matriks_x', 'matriks_x_transformed', 'matriks_x0', 'matriks_r', 'matriks_terbobot', 'nilai_s', 'nilai_s0', 'tingkat_utilitas_k');
    }
}