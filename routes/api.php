<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\PendudukController;

// Route::get('/penduduk', [PendudukController::class, 'index']);
Route::get('/penduduk/{Penduduk:nik}', [PendudukController::class, 'show']);
Route::get('/chart', [PendudukController::class, 'chart']);

Route::prefix('/alamat')->group(function(){
    Route::get('/provinsi', [AlamatController::class, 'get_provinsi']);
    Route::get('/kabupaten/{id}', [AlamatController::class, 'get_kabupaten']);
    Route::get('/kecamatan/{id}', [AlamatController::class, 'get_kecamatan']);
    Route::get('/desa/{id}', [AlamatController::class, 'get_desa']);
    Route::get('/kodepos/{id}', [AlamatController::class, 'get_kodepos']);
});

