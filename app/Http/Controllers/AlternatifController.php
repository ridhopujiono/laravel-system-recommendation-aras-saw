<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::orderBy('nama', 'asc')->get();
        return view('alternatif.index', compact('alternatif'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $alternatif = Alternatif::create($request->all());
        return response()->json(['success' => 'Data alternatif berhasil ditambahkan.', 'data' => $alternatif]);
    }

    public function edit($id)
    {
        $alternatif = Alternatif::find($id);
        if (!$alternatif) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($alternatif);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $alternatif = Alternatif::find($id);
        if (!$alternatif) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        
        $alternatif->update($request->all());
        return response()->json(['success' => 'Data alternatif berhasil diperbarui.', 'data' => $alternatif]);
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::find($id);
        if (!$alternatif) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $alternatif->delete();
        return response()->json(['success' => 'Data alternatif berhasil dihapus.']);
    }
}