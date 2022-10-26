<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tramite;
use App\Models\User;

class TramiteSolicitadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tramite_id = $this->faker->numberBetween($min = 1, $max = 5);
        $reqs_assign = Tramite::find($tramite_id)->first()->requerimientos;

        $isStudent = $this->faker->numberBetween($min = 1, $max = 20);
        $student = User::where('id', $isStudent )->whereRaw('LENGTH(codigo) > 7')->first();
        $randomEstatus = $this->faker->numberBetween($min = 1, $max = 4); //1:Pendiente, 2: Finalizado, 3: Archivado, 4: Rechazado.
        $categoria = 'solicitido';

        if($randomEstatus == 2) $categoria = 'finalizado';
        if($randomEstatus == 3) $categoria = 'archivado';
        if($randomEstatus == 4) $categoria = 'rechazado';

        if(!isset($student)){ //is selected number is not student, assign manually to student 1: Me
            return [
                'student_id' => $this->faker->numberBetween($min = 1, $max = 3), //manual students created
                'tramite_id' => $tramite_id,
                'requerimientos_asignados' => $reqs_assign,
                'categoria' => $categoria,
                'folio' => $this->faker->unique()->numberBetween($min = 1, $max = 2000),
                'created_at' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null),
            ];
        }

        return [
            'student_id' => $isStudent,
            'tramite_id' => $tramite_id,
            'requerimientos_asignados' => $reqs_assign,
            'folio' => $this->faker->unique()->numberBetween($min = 1, $max = 2000),
            'created_at' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null),
        ];
    }
}
