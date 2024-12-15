<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendudukController;
// Buat pakai apa (framework=laravel,bahasa,database) --> 
// Cara menjalankan (ada banyak cara dengan valet, laragon, dan artisan serve)-->
// Cara buat (html, css lalu dimasukan ke laravel->alasan utama bisa input data banyak oleh bawaan laravel)
// Bentuk laporan (scema 1 scema 2) -> individu

// guest
Route::get('/', function () {
    return redirect('/beranda');
});
Route::get('/beranda', [GuestController::class, 'index']);
Route::get('/about', [GuestController::class, 'index']);
Route::get('/faq', [GuestController::class, 'index']);
Route::get('/contact', [GuestController::class, 'index']);
// guest end

// login start
Route::get('/masuk', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/masuk', [LoginController::class, 'masuk'])->middleware('throttle:5,1');
// logout
Route::post('/keluar', [LoginController::class, 'keluar'])->middleware('auth')->name('logout');
// login  end

// dashboard admin start
Route::prefix('/dashboard')->middleware(['auth','admin'])->group(function(){
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/datapindah', [AdminController::class, 'index_domisili']);
    Route::get('/ubah/{penduduk:nik}', [PendudukController::class, 'show']);
    Route::get('/tambah', [PendudukController::class, 'create']);
    Route::get('/pindah', [PendudukController::class, 'create_domisili']);
    Route::post('/pindah', [PendudukController::class, 'store_domisili']);
    Route::post('/tambah', [PendudukController::class, 'store']);
    Route::post('/ubah/{penduduk:nik}', [PendudukController::class, 'edit']);
    Route::post('/hapus/{penduduk:nik}', [PendudukController::class, 'destroy']);
});
// dashboard admin end

Route::get('/api/penduduk', [PendudukController::class, 'index']);


Route::get('/test/{id}', function($id){
    // $provinsiResponse = Http::get(url('https://dataduk.test/api/alamat/provinsi',[],['verify' => false]));
    $provinsiResponse = Http::withOptions([
        'verify' => false
    ])->get('https://dataduk.test/api/alamat/provinsi');
    $data = $provinsiResponse->json();
    $randomProvinsi = $data[array_rand($data)];
    dd($randomProvinsi);


    // Cetak data random

    // foreach ($data as $provinsi) {
        // dd($provinsi);
    // }
});