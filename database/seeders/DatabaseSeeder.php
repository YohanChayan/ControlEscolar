<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CarreraSeeder::class,
            CicloSeeder::class,
            UserSeeder::class,
            TramiteSeeder::class,
            TramiteSolicitadoSeeder::class,
        ]);
    }
}
