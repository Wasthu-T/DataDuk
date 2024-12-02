<?php

use App\Models\Penduduk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendudukController;

// Route::get('/beranda', function () {
    // $data = Penduduk::paginate(10); 
//     return $data;
// });
Route::get('/p/{penduduk:nik}', function (Penduduk $penduduk) {
    return $penduduk;
});
// login start
Route::get('/masuk', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/masuk', [LoginController::class, 'masuk'])->middleware('throttle:5,1');
// logout
Route::post('/keluar', [LoginController::class, 'keluar'])->middleware('auth')->name('logout');
// login  end

// dashboard admin start
Route::prefix('/dashboard')->middleware(['auth','admin'])->group(function(){
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/ubah/{penduduk:nik}', [PendudukController::class, 'show']);
    Route::get('/tambah', [PendudukController::class, 'create']);
    Route::post('/tambah', [PendudukController::class, 'store']);
    Route::post('/ubah/{penduduk:nik}', [PendudukController::class, 'edit']);
    Route::post('/hapus/{penduduk:nik}', [PendudukController::class, 'destroy']);
});
// dashboard admin end

Route::get('/api/penduduk', [PendudukController::class, 'index']);

