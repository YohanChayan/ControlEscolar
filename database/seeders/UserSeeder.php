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
            'clave_carrera' => 'ANT',
            'nombre_carrera' => 'Licenciatura en Antropología',
            'ciclo_admision' => '2021A',
            'estatus' => 'Activo',
            'ciclo_admision' => '2019A',
            'password' => Hash::make('1q2w3e4r'),
            'email_verified_at' => Carbon::now(),
        ]);

        // student verified
        // User::create([
        //     'role' => 'student',
        //     'name' => 'Jose Rafael',
        //     'apellidos' => 'Leonett Carvajal',
        //     'email' => 'student1@gmail.com',
        //     'codigo' => '219750265',
        //     'telefono' => '+14155238886',
        //     'clave_carrera' => 'LGE',
        //     'nombre_carrera' => 'Licenciatura en Geografía',
        //     'ciclo_admision' => '2021A',
        //     'estatus' => 'Activo',
        //     'ciclo_admision' => '2019A',
        //     'password' => Hash::make('1q2w3e4r'),
        //     'email_verified_at' => Carbon::now(),
        // ]);
        // student verified
        // User::create([
        //     'role' => 'student',
        //     'name' => 'Carlos Gonzales',
        //     'apellidos' => 'Lopez Ramirez',
        //     'email' => 'student2@gmail.com',
        //     'codigo' => '219750266',
        //     'telefono' => '+14155238886',
        //     'clave_carrera' => 'SOCI',
        //     'nombre_carrera' => 'Licenciatura en Sociología',
        //     'ciclo_admision' => '2021A',
        //     'estatus' => 'Activo',
        //     'ciclo_admision' => '2019A',
        //     'password' => Hash::make('1q2w3e4r'),
        //     'email_verified_at' => Carbon::now(),
        // ]);

        // admin verified
        User::create([
            'role' => 'admin',
            'name' => 'Yohan Chayan',
            'apellidos' => 'Lopez Hermandez',
            'email' => 'admin@gmail.com',
            'codigo' => '1111111',
            'telefono' => '3320494387',
            'estatus' => 'Activo',
            'password' => Hash::make('1q2w3e4r'),
            'email_verified_at' => Carbon::now(),
        ]);

        // coordinador verified
        User::create([
            'role' => 'coordinador',
            'name' => 'Ncoordinador',
            'apellidos' => 'Apellido1 Apellido2',
            'email' => 'coor@gmail.com',
            'codigo' => '1111112',
            'telefono' => '3320494387',
            'estatus' => 'Activo',
            'password' => Hash::make('1q2w3e4r'),
            'email_verified_at' => Carbon::now(),
        ]);

        // User::factory()->count(20)->create();
        User::factory()->count(4000)->create();
    }
}
