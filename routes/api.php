<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\DomisiliController;
use App\Http\Controllers\PendudukController;


Route::get('/domisili', [DomisiliController::class, 'index']);
Route::get('/penduduk/{statuspenduduk:nik}', [PendudukController::class, 'show_api']);
Route::get('/domisili/chart', [DomisiliController::class, 'chart']);
Route::get('/chart', [PendudukController::class, 'chart']);

Route::prefix('/alamat')->group(function(){
    Route::get('/provinsi', [AlamatController::class, 'get_provinsi']);
    Route::get('/kabupaten/{id}', [AlamatController::class, 'get_kabupaten']);
    Route::get('/kecamatan/{id}', [AlamatController::class, 'get_kecamatan']);
    Route::get('/desa/{id}', [AlamatController::class, 'get_desa']);
    Route::get('/kodepos/{id}', [AlamatController::class, 'get_kodepos']);
});


