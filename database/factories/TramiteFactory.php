<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TramiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_tramite' => $this->faker->title,
            'monto' => $this->faker->numberBetween($min = 50, $max = 100),
            'requerimientos' => $this->faker->text,

        ];
    }
}
