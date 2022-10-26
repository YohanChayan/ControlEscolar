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
            'monto' => 91.00,
            'requerimientos' => '5 fotografías de estudio tamaño credencial, blanco y negro, cuadradas, con auto adherible, vestimenta formal. (Hombres: saco negro y corbata. Damas: blusa blanca y saco negro).|Dictamen de revalidación de materias',
            // 'aviso' => 'El tramite puede tardar de 15 a 30 días hábiles',
        ]);
        Tramite::create([
            'nombre_tramite' => 'Certificado total de estudio',
            'monto' => 91.00,
            'requerimientos' => '5 fotografías de estudio tamaño credencial, blanco y negro, cuadradas, con auto adherible, vestimenta formal. (Hombres: saco negro y corbata. Damas: blusa blanca y saco negro).',
            // 'aviso' => 'El tramite puede tardar de 20 a 40 días hábiles',
        ]);
        Tramite::create([
            'nombre_tramite' => 'Certificado de graduado',
            'monto' => 218.00,
            'requerimientos' => 'Copia certificada del acta de titulación |Copia simple de la constancia de liberación del Servicio Social (sólo licenciaturas)|5 fotografías de estudio tamaño credencial, blanco y negro, cuadradas, con auto adherible, vestimenta formal. (Hombres: saco negro y corbata. Damas: blusa blanca y saco negro).|Dictamen de revalidación de materias',
            'referencia' => '9 000 000 2585',
            // 'aviso' => 'El tramite puede tardar de 30 a 50 días hábiles',
        ]);

        Tramite::create([
            'nombre_tramite' => 'Acta de titulación',
            'monto' => 91.00,
            'requerimientos' => 'Copia certificada de acta de titulación|1 Fotografía de estudio por cada acta, en tamaño credencial cuadrada blanca y negro, con auto adherible (Hombres: saco negro y corbata. Damas: blusa blanca y saco negro).',
            // 'aviso' => 'El tramite puede tardar de 30 a 60 días hábiles',
        ]);

        Tramite::create([
            'nombre_tramite' => 'Constancia de no adeudo',
            'monto' => 31.00,
            'requerimientos' => 'Certificado de bachillerato|Certificado de Licenciatura/Maestría|Copia del título Licenciatura/Maestría|Copia cedula federal|Validación de certificado de estudios previos',
            'formato' => 'formato_constanciaNoAdeudo',
            'referencia' => '9 000 000 5448',
            // 'aviso' => 'El tramite puede tardar de 30 a 60 días hábiles',
        ]);
        // Tramite::factory()->count(10)->create();

    }
}
