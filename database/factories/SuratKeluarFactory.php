<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratKeluar>
 */
class SuratKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unit_pengolahan' => $this->faker->company,
            'unit_pencipta' => $this->faker->companySuffix,
            'nomor_berkas' => $this->faker->optional()->bothify('NB-####'),
            'nomor_item' => $this->faker->optional()->bothify('NI-####'),
            'kode_klasifikasi' => $this->faker->optional()->numerify('###.##'),
            'uraian' => $this->faker->sentence,
            'tanggal' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'tingkat_perkembangan' => $this->faker->optional()->randomElement(['Asli', 'Copy', 'Draft']),
            'keterangan' => $this->faker->optional()->sentence,
        ];
    }
}
