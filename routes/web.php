<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KriteriaController;

// Rute utama untuk menampilkan halaman
Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');

// Rute untuk proses CRUD via AJAX
Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
Route::get('kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::put('kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');


// Rute untuk Alternatif
Route::get('alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
Route::post('alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
Route::get('alternatif/{id}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
Route::put('alternatif/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');
Route::delete('alternatif/{id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
Route::post('penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');


Route::get('/perhitungan/saw', [PerhitunganController::class, 'saw'])->name('perhitungan.saw');
Route::get('/perhitungan/aras', [PerhitunganController::class, 'aras'])->name('perhitungan.aras');
Route::get('/hasil', [PerhitunganController::class, 'hasil'])->name('hasil.index');
