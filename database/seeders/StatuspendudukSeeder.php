<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\StatusPenduduk;

class StatuspendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niks = Penduduk::pluck('nik'); // Ambil semua NIK dari tabel penduduks

        foreach ($niks as $nik) {
            StatusPenduduk::create([
                'nik' => $nik, // Gunakan NIK dari tabel penduduks
                'nama' => fake()->name,
                'agama' => fake()->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu']),
                'stt_kawin' => fake()->randomElement(['kawin', 'belum kawin']),
                'pekerjaan' => fake()->jobTitle,
                'kwn' => fake()->randomElement(['WNI', 'WNA']),
            ]);
        }
    }
}
