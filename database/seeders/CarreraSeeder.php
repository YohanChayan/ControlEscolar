<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrera;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrera::create([
            'nombre' => 'Licenciatura en Antropología',
            'clave' => 'ANT LANT',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Comunicación Pública',
            'clave' => 'COP',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Criminología',
            'clave' => 'LCRI',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Derecho',
            'clave' => 'DECH DER DERR DES DERC',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Derecho Semiescolarizado',
            'clave' => 'ABO DESE DESR',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Didáctica del Francés como Lengua Extranjera',
            'clave' => 'DFR LEX',
        ]);

// clave no asignada
        Carrera::create([
            'nombre' => 'Licenciatura en Docencia del Inglés (Modalidad Semiescolarizada Abierta y a Distancia)',
            'clave' => 'No asignado',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Docencia del Inglés como Lengua Extranjera',
            'clave' => 'SDOI LDI DIS ING',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Escritura Creativa',
            'clave' => 'LESC',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Estudios Políticos y Gobierno',
            'clave' => 'EPG EPGB EPGO',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Filosofía',
            'clave' => 'FIL LFI LFIL',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Geografía',
            'clave' => 'LGEO GEO GEOT LGE',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Historia',
            'clave' => 'LHTO HID LHT',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Letras Hispánicas',
            'clave' => 'LHI LLEH LLH LLHI',
        ]);

        Carrera::create([
            'nombre' => 'Nivelación a la Licenciatura en Trabajo Social (NiLiTS)',
            'clave' => 'NTS',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Estudios intrnacionales',
            'clave' => 'EIN EINT LEIN',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Relaciones Internacionales',
            'clave' => 'LRIN REIN',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Sociología',
            'clave' => 'LSOC SOC SOCI',
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Trabajo Social',
            'clave' => 'TSO LTRA LTRS LTS LTSO',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Bioética',
            'clave' => 'MBIO',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Ciencia Política',
            'clave' => 'MCPO MICP MACP MCIP',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN GLOBAL POLITICS',
            'clave' => 'MGPT',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Ciencias Sociales',
            'clave' => 'MICG RMSO',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN CIENCIAS SOCIALES CON ORIENTACION',
            'clave' => 'MACS',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Comunicación',
            'clave' => 'MICN MACU RMCS',
        ]);
        //

        Carrera::create([
            'nombre' => 'Maestría en Derecho',
            'clave' => 'MIDR MDRE DEMA IDE',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DCHO CON ORIENTACION EN DERECHO C',
            'clave' => 'MCOA',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DCHO CON ORIENTACION  DERECHO CORPORATIVO',
            'clave' => 'MCOR',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO AMBIENTAL',
            'clave' => 'MDAD',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO ADMINISTRATIVO',
            'clave' => 'MDAS',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CONSTITUCIONAL',
            'clave' => 'MDCA',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CIVIL Y FAMILIAR',
            'clave' => 'MDCF',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION EN CRMINOLOGIA',
            'clave' => 'MDCR',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION EN DERECHO AGRARIO',
            'clave' => 'MDEA',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION',
            'clave' => 'MDEE',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO FISCAL',
            'clave' => 'MDF',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION',
            'clave' => 'MDNA RMDE',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO NOTARIAL',
            'clave' => 'MDNF MNOR',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO NEGOCIACIONES',
            'clave' => 'MDNS',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO PENAL Y CRIMINALISTICA',
            'clave' => 'MDPC',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIETACION EN ADMINISTRACION Y ',
            'clave' => 'MASP',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION EN NEGOCIOS C',
            'clave' => 'MNES',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Desarrollo Local y Territorio',
            'clave' => 'IDE MIDC',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Enseñanza del Inglés como Lengua Extranjera (Programa Nacional de Posgrados de CONACYT)',
            'clave' => 'MIEE IEI MLEE',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios críticos del lenguaje',
            'clave' => 'MECL',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios de las Lenguas y Culturas Inglesas (Programa Nacional de Posgrados de CONACYT)',
            'clave' => 'MACI',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios de Literatura Mexicana',
            'clave' => 'MELM MIEL MIES',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios Filosóficos',
            'clave' => 'MAEF MUEF',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios Francófonos: Pedagogía, Lingüística y Estudios Interculturales',
            'clave' => 'MFPL',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios Mesoamericanos',
            'clave' => 'MEME',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Gestión y Desarrollo Social',
            'clave' => 'MGDS MIGT',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Global Politics and Transpacific Studies',
            'clave' => 'No asignado',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Historia de México',
            'clave' => 'MIHM RMHM MHME',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Investigación Educativa',
            'clave' => 'INED',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Lingüística Aplicada',
            'clave' => 'MILA MLAP MLIA RMLA',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Literaturas Interamericanas',
            'clave' => 'MLIE',
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Relaciones Internacionales de Gobiernos y Actores Locales (Programa Nacional de Posgrados del CONACYT)',
            'clave' => 'MRIG',
        ]);

        Carrera::create([
            'nombre' => 'Maestría Interinstitucional en Deutsch als Fremdsprache: Estudios Interculturales de Lengua, Literatura y Cultura Alemanas',
            'clave' => 'MIDF',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN CS FORENSES Y CRIMINOLOGIA',
            'clave' => 'MARC MINO',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN CS FORENSES OR MED FORENSE',
            'clave' => 'MCCM MCMF',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA CS FORENSE OR CRIMINALISTICA',
            'clave' => 'MCCR',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA CS SOCIO MEDICAS',
            'clave' => 'MCNS',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN LITERATURA COMPARADA',
            'clave' => 'MILC',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN INVESTIGACION EN C',
            'clave' => 'MIIC MMID',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN ESTUDIOS DE LAS LENGUAS',
            'clave' => 'MLEI',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN FILOSOFIA',
            'clave' => 'RMFL',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN ENSEÑANZA DE LA LENGUA',
            'clave' => 'RMLL',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN LITERATURA DEL SIGLO XX',
            'clave' => 'RMLS',
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN TRABAJO SOCIAL',
            'clave' => 'RMTS',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Ciencia Política',
            'clave' => 'DCIP DOCP DCPO',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Ciencias Sociales',
            'clave' => 'DCIS DUCN DUSO',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Cognición y Aprendizaje',
            'clave' => 'DCOA',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Derecho',
            'clave' => 'DCDR',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Educación',
            'clave' => 'DOED DUED DUEU',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Geografía y Ordenación Territorial',
            'clave' => 'DGTL DOGO',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Historia',
            'clave' => 'DOCH DOHI',
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Humanidades',
            'clave' => 'DOHU',
        ]);

        Carrera::create([
            'nombre' => 'DOC EN CS SOCIO MEDICAS',
            'clave' => 'DCNS',
        ]);

        Carrera::create([
            'nombre' => 'DOCTORADO INTERINSTITUCIONAL EN',
            'clave' => 'DUID',
        ]);

        Carrera::create([
            'nombre' => 'DOCTORADO EN LETRAS',
            'clave' => 'DULE',
        ]);

        Carrera::create([
            'nombre' => 'DOC EN ESTUDIOS LITERARIOS',
            'clave' => 'DULL',
        ]);

        Carrera::create([
            'nombre' => 'ESPECIALIDA EN LA ENSEÑAÑNZA DEL ALEMAN',
            'clave' => 'RXEA XEA XEL',
        ]);

        Carrera::create([
            'nombre' => 'ESPECIALIZACION EN EDUCADOR DE CALLE',
            'clave' => 'RXED',
        ]);

    }
}
