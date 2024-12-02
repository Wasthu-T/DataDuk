<?php

use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;

// Route::get('/penduduk', [PendudukController::class, 'index']);
Route::get('/penduduk/{Penduduk:nik}', [PendudukController::class, 'show']);
Route::get('/chart', [PendudukController::class, 'chart']);
