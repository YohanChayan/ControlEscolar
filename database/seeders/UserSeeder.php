<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // student verified
        User::create([
            'role' => 'student',
            'name' => 'Yohan Eduardo',
            'apellidos' => 'Chayan Leonett',
            'email' => 'yohan.chayan7502@alumnos.udg.mx',
            'codigo' => '219750264',
            'telefono' => '+14155238886',
            // 'telefono' => '+523320494387',
            'carrera_id' => 1,
            'clave_carrera' => 'ANT LANT - Licenciatura en Antropología',
            'ciclo_admision' => '2019A',
            'password' => Hash::make('1q2w3e4r'),
            'email_verified_at' => Carbon::now(),
        ]);

        // student verified -- NOT ROLE
        User::create([
            'name' => 'Estudiante',
            'apellidos' => 'E',
            'email' => 'student1@gmail.com',
            'codigo' => '111111111',
            'telefono' => '3320494387',
            'clave_carrera' => 'ANT LANT - Licenciatura en Antropología',
            'ciclo_admision' => '2019A',
            'password' => Hash::make('1q2w3e4r'),
            'email_verified_at' => Carbon::now(),
        ]);

        // admin verified
        User::create([
            'role' => 'admin',
            'name' => 'Admin Eduardo',
            'apellidos' => 'Chayan',
            'email' => 'admin@gmail.com',
            'codigo' => '1111111',
            'telefono' => '3320494387',
            'password' => Hash::make('1q2w3e4r'),
            'email_verified_at' => Carbon::now(),
        ]);

        User::factory()->count(12)->create();

    }
}
