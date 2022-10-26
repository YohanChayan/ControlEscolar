<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TramiteSolicitado;

class TramiteSolicitadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TramiteSolicitado::factory()->count(2000)->create();
    }
}
