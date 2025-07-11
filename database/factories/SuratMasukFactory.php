<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
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
            'unit_pencipta' => $this->faker->company,
            'nomor_berkas' => strtoupper($this->faker->bothify('NB-###/??')),
            'nomor_item' => strtoupper($this->faker->bothify('ITM-###')),
            'kode_klasifikasi' => $this->faker->randomElement(['A.1', 'B.2', 'C.3']),
            'tanggal' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'tingkat_perkembangan' => $this->faker->randomElement(['Asli', 'Copy', 'Salinan']),
            'uraian' => $this->faker->sentence(8),
            'keterangan' => $this->faker->optional()->sentence(6),
        ];
    }
}
