<?php

namespace Database\Seeders;

use App\Models\Domisili;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\StatusPenduduk;
use Illuminate\Support\Facades\Storage;

class DomisiliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = StatusPenduduk::select('nik', 'alamat')->take(100)->get(); // Ambil semua NIK dari tabel penduduks
        $url = 'https://dataduk.test/pdf/Pindah%20Domisili.pdf';
        $pdfContent = Http::withOptions(['verify' => false])->get($url)->body(); 

        foreach ($datas as $data) {
            $provinsiResponse = Http::withOptions([
                'verify' => false
            ])->get('https://dataduk.test/api/alamat/provinsi/');
            $provinsiData = $provinsiResponse->json();
            $randomprovinsi = $provinsiData[array_rand($provinsiData)];

            $kabupatenResponse = Http::withOptions([
                'verify' => false
            ])->get('https://dataduk.test/api/alamat/kabupaten/' . $randomprovinsi['kode_provinsi']);
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

            // Buat nama file unik
            $filename = 'pdf_' . time() . '_' . $data['nik'] . '.pdf';
            $path = 'pdf/' . $filename;
            Storage::disk('public')->put($path, $pdfContent);

            Domisili::create([
                'nik' => $data['nik'],
                'alamat_asal' => fake()->street . ", {$randomdesa['nama_desa']}, {$randomkecamatan['nama_kecamatan']}, {$randomKabupaten['nama_kabupaten']}, {$randomprovinsi['nama_provinsi']}",
                'alamat_tujuan' => $data['alamat'],
                'tanggal_pindah' => fake()->dateTimeBetween('-17 years', 'now')->format('Y-m-d'),
                'alasan_pindah' => fake()->sentence(10),
                'link' => '/storage/' . $path,
                'status' => "1",
            ]);
        }
    }
}
