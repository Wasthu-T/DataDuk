<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use App\Models\StatusPenduduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatuspendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niks = Penduduk::pluck('nik'); // Ambil semua NIK dari tabel penduduks
        $randomProvinsi = [
            "kode_provinsi" => "34",
            "nama_provinsi" => "DI Yogyakarta"
        ];

        foreach ($niks as $nik) {
            $kabupatenResponse = Http::withOptions([
                'verify' => false
            ])->get('https://dataduk.test/api/alamat/kabupaten/' . $randomProvinsi['kode_provinsi']);
            $kabupatenData = $kabupatenResponse->json();
            $randomKabupaten = $kabupatenData[array_rand($kabupatenData)];

            $kecamatanResponse = Http::withOptions([
                'verify' => false
            ])->get('https://dataduk.test/api/alamat/kecamatan/' . $randomKabupaten['kode_kabupaten']);
            $kecamatanData = $kecamatanResponse->json();
            $randomkecamatan = $kecamatanData[array_rand($kecamatanData)];

            $desaResponse = Http::withOptions([
                'verify' => false
            ])->get('https://dataduk.test/api/alamat/desa/' . $randomkecamatan['kode_kecamatan']);
            $desaData = $desaResponse->json();
            $randomdesa = $desaData[array_rand($desaData)];

            StatusPenduduk::create([
                'nik' => $nik, // Gunakan NIK dari tabel penduduks
                'nama' => fake()->name,
                'alamat' => "{$randomdesa['nama_desa']}, {$randomkecamatan['nama_kecamatan']}, {$randomKabupaten['nama_kabupaten']}, {$randomProvinsi['nama_provinsi']}",
                'agama' => fake()->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu']),
                'stt_kawin' => fake()->randomElement(['kawin', 'belum kawin']),
                'pekerjaan' => fake()->jobTitle,
                'kwn' => "WNI",
            ]);
        }
    }
}
