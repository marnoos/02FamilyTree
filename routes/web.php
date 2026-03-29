<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/anggota/tambah', [AnggotaController::class, 'create']);
Route::post('/anggota/simpan', [AnggotaController::class, 'store']);
Route::get('/anggota', [AnggotaController::class, 'index']);

Route::get('/pohon', [AnggotaController::class, 'pohon']);

// Edit & Update
Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit']);
Route::post('/anggota/update/{id}', [AnggotaController::class, 'update']);

// Delete
Route::get('/anggota/hapus/{id}', [AnggotaController::class, 'destroy']);
