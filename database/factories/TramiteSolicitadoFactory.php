<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TramiteSolicitadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 12),
            'tramite_id' => $this->faker->numberBetween($min = 1, $max = 4),
            'estatus' => 'Recepción de tramite recibido en CE',
            // 'estadistico' => $this->faker->numberBetween($min = 0, $max = 1),
            'estadistico' => 1,
            'folio' => $this->faker->unique()->numberBetween($min = 0, $max = 100),
        ];
    }
}
