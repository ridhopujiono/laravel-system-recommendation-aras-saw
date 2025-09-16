<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KriteriaController;

// Rute utama untuk menampilkan halaman
Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');

// Rute untuk proses CRUD via AJAX
Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
Route::get('kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::put('kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');