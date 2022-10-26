<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Illuminate\Support\Facades\Hash;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $isStudent = $this->faker->boolean();
        $random_id = $this->faker->numberBetween(1,160);
        $career = Carrera::find($random_id);

        return [

            'role' => 'none',
            'name' => $this->faker->name(),
            'apellidos' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber,
            // 'clave_carrera' => ($isStudent)  ? 'ANT' : null,
            // 'nombre_carrera' => ($isStudent) ? 'Licenciatura en Antropología' : null,
            'clave_carrera' => ($isStudent)  ? $career->clave : null,
            'nombre_carrera' => ($isStudent) ? $career->nombre : null,
            'ciclo_admision' => '2022B',
            'codigo' => $this->faker->unique()->randomNumber( ($isStudent) ? 9 : 7 , $strict = true),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
