<?php

namespace App\Http\Controllers;

use App\Models\Kriteria; // Pastikan Anda sudah membuat model Kriteria
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar kriteria.
     */
    public function index()
    {
        $kriteria = Kriteria::orderBy('kode_kriteria', 'asc')->get();
        return view('kriteria.index', compact('kriteria'));
    }

    /**
     * Menyimpan data kriteria baru yang dikirim via AJAX.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|string|max:5|unique:kriteria,kode_kriteria',
            'keterangan' => 'required|string|max:100',
            'bobot' => 'required|numeric|min:0',
            'jenis' => 'required|in:benefit,cost',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kriteria = Kriteria::create($request->all());

        return response()->json([
            'success' => 'Data kriteria berhasil ditambahkan.',
            'data' => $kriteria
        ]);
    }

    /**
     * Mengambil data kriteria untuk diedit dan mengirimnya sebagai JSON.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        if (!$kriteria) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($kriteria);
    }

    /**
     * Memperbarui data kriteria yang dikirim via AJAX.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required|string|max:5|unique:kriteria,kode_kriteria,' . $id,
            'keterangan' => 'required|string|max:100',
            'bobot' => 'required|numeric|min:0',
            'jenis' => 'required|in:benefit,cost',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kriteria = Kriteria::find($id);
        if (!$kriteria) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        
        $kriteria->update($request->all());

        return response()->json([
            'success' => 'Data kriteria berhasil diperbarui.',
            'data' => $kriteria
        ]);
    }

    /**
     * Menghapus data kriteria via AJAX.
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        if (!$kriteria) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $kriteria->delete();
        return response()->json(['success' => 'Data kriteria berhasil dihapus.']);
    }
}