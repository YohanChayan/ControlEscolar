<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tramite;

class TramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tramite::create([
            'nombre_tramite' => 'Certificado parcial de estudio',
            'monto' => '$91.00',
            'requerimientos' => 'reqs',
        ]);

        Tramite::create([
            'nombre_tramite' => 'Certificado total de estudio',
            'monto' => '$91.00',
            'requerimientos' => 'reqs',
        ]);

        Tramite::create([
            'nombre_tramite' => 'Certificado de graduado',
            'monto' => '$218.00',
            'requerimientos' => 'reqs',
        ]);

        Tramite::create([
            'nombre_tramite' => 'Acta de titulacion',
            'monto' => '$91.00',
            'requerimientos' => 'reqs',
        ]);

        // Tramite::factory()->count(10)->create();

    }
}
