<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penduduk>
 */
class PendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->regexify('[1-9][0-9]{15}'),
            'tmp_lahir' => $this->faker->city(),
            'tgl_lahir' => $this->faker->date('Y-m-d', '2007-11-30'),
            'jns_kel' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'gol_d' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            // 'nama' => $this->faker->name(),
            // 'alamat' => $this->faker->address(),
            // 'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            // 'stt_kawin' => $this->faker->randomElement(['kawin', 'belum kawin']),
            // 'pekerjaan' => $this->faker->jobTitle(),
            // 'kwn' => $this->faker->randomElement(['WNI'])
        ];
    }
}
