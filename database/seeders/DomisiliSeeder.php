<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Domisili;

class DomisiliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsiResponse = Http::withOptions([
            'verify' => false
        ])->get('https://dataduk.test/api/alamat/provinsi');
        $provinsiData = $provinsiResponse->json();

        foreach ($provinsiData as $provinsi) {
            // Ambil data kabupaten berdasarkan provinsi
            $kabupatenResponse = Http::get('/api/kabupaten', [
                'kode_provinsi' => $provinsi['kode_provinsi']
            ]);
            $kabupatenData = $kabupatenResponse->json();

            foreach ($kabupatenData as $kabupaten) {
                // Ambil data kecamatan berdasarkan kabupaten
                $kecamatanResponse = Http::get('/api/kecamatan', [
                    'kode_kabupaten' => $kabupaten['kode_kabupaten']
                ]);
                $kecamatanData = $kecamatanResponse->json();

                foreach ($kecamatanData['kecamatan'] as $kecamatan) {
                    // Ambil data desa berdasarkan kecamatan
                    $desaResponse = Http::get('/api/desa', [
                        'kode_kecamatan' => $kecamatan['kode_kecamatan']
                    ]);
                    $desaData = $desaResponse->json();

                    foreach ($desaData['desa'] as $desa) {
                        // Simpan data ke database dengan faker
                        Domisili::create([
                            'nik' => fake()->numerify('###########'), // NIK palsu
                            'alamat_tujuan' => "{$desa['nama_desa']}, {$kecamatan['nama_kecamatan']}, {$kabupaten['nama_kabupaten']}, {$provinsi['nama_provinsi']}",
                            // 'alamat_tujuan' => fake()->address,
                            'keterangan' => fake()->sentence,
                            'tanggal_pindah' => fake()->date,
                            'alasan_pindah' => fake()->optional()->sentence,
                            'status' => fake()->boolean,
                        ]);
                    }
                }
            }
        }
    }
}
