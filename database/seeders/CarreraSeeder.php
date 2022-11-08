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
            'clave' => 'ANT',
            'wrapperID' => 1,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Antropología',
            'clave' => 'LANT',
            'wrapperID' => 1,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Comunicación Pública',
            'clave' => 'COP',
            'wrapperID' => 2,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Criminología',
            'clave' => 'LCRI',
            'wrapperID' => 3,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Derecho',
            'clave' => 'DERC',
            'wrapperID' => 4,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Derecho',
            'clave' => 'DES',
            'wrapperID' => 4,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Derecho',
            'clave' => 'DERR',
            'wrapperID' => 4,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Derecho',
            'clave' => 'DER',
            'wrapperID' => 4,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Derecho',
            'clave' => 'DECH',
            'wrapperID' => 4,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Derecho Semiescolarizado',
            'clave' => 'DESR',
            'wrapperID' => 5,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Derecho Semiescolarizado',
            'clave' => 'DESE',
            'wrapperID' => 5,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Derecho Semiescolarizado',
            'clave' => 'ABO',
            'wrapperID' => 5,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Didáctica del Francés como Lengua Extranjera',
            'clave' => 'LEX',
            'wrapperID' => 6,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Didáctica del Francés como Lengua Extranjera',
            'clave' => 'DFR',
            'wrapperID' => 6,
        ]);

// clave no asignada
        Carrera::create([
            'nombre' => 'Licenciatura en Docencia del Inglés (Modalidad Semiescolarizada Abierta y a Distancia)',
            'clave' => 'No asignado',
            'wrapperID' => 7,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Docencia del Inglés como Lengua Extranjera',
            'clave' => 'ING',
            'wrapperID' => 8,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Docencia del Inglés como Lengua Extranjera',
            'clave' => 'DIS',
            'wrapperID' => 8,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Docencia del Inglés como Lengua Extranjera',
            'clave' => 'LDI',
            'wrapperID' => 8,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Docencia del Inglés como Lengua Extranjera',
            'clave' => 'SDOI',
            'wrapperID' => 8,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Escritura Creativa',
            'clave' => 'LESC',
            'wrapperID' => 9,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Estudios Políticos y Gobierno',
            'clave' => 'EPGO',
            'wrapperID' => 10,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Estudios Políticos y Gobierno',
            'clave' => 'EPGB',
            'wrapperID' => 10,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Estudios Políticos y Gobierno',
            'clave' => 'EPG',
            'wrapperID' => 10,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Filosofía',
            'clave' => 'LFIL',
            'wrapperID' => 11,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Filosofía',
            'clave' => 'LFI',
            'wrapperID' => 11,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Filosofía',
            'clave' => 'FIL',
            'wrapperID' => 11,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Geografía',
            'clave' => 'LGE',
            'wrapperID' => 12,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Geografía',
            'clave' => 'GEOT',
            'wrapperID' => 12,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Geografía',
            'clave' => 'GEO',
            'wrapperID' => 12,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Geografía',
            'clave' => 'LGEO',
            'wrapperID' => 12,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Historia',
            'clave' => 'LHTO',
            'wrapperID' => 13,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Historia',
            'clave' => 'HIS',
            'wrapperID' => 13,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Historia',
            'clave' => 'LHT',
            'wrapperID' => 13,
        ]);
        // Carrera::create([
        //     'nombre' => 'Licenciatura en Historia',
        //     'clave' => 'HID',
        //     'wrapperID' => 13,
        // ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Letras Hispánicas',
            'clave' => 'LLHI',
            'wrapperID' => 14,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Letras Hispánicas',
            'clave' => 'LLH',
            'wrapperID' => 14,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Letras Hispánicas',
            'clave' => 'LLEH',
            'wrapperID' => 14,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Letras Hispánicas',
            'clave' => 'LHI',
            'wrapperID' => 14,
        ]);

        Carrera::create([
            'nombre' => 'Nivelación a la Licenciatura en Trabajo Social (NiLiTS)',
            'clave' => 'NTS',
            'wrapperID' => 15,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Estudios intrnacionales',
            'clave' => 'LEIN',
            'wrapperID' => 16,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Estudios internacionales',
            'clave' => 'EINT',
            'wrapperID' => 16,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Estudios intrnacionales',
            'clave' => 'EIN',
            'wrapperID' => 16,
        ]);

//         Carrera::create([
//             'nombre' => 'Licenciatura en Relaciones Internacionales',
//             'clave' => 'REIN',
//             'wrapperID' => 16,
//         ]);
//
//         Carrera::create([
//             'nombre' => 'Licenciatura en Relaciones Internacionales',
//             'clave' => 'LRIN',
//             'wrapperID' => 16,
//         ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Sociología',
            'clave' => 'SOCI',
            'wrapperID' => 17,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Sociología',
            'clave' => 'SOC',
            'wrapperID' => 17,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Sociología',
            'clave' => 'LSOC',
            'wrapperID' => 17,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Trabajo Social',
            'clave' => 'LTSO',
            'wrapperID' => 18,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Trabajo Social',
            'clave' => 'LTS',
            'wrapperID' => 18,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Trabajo Social',
            'clave' => 'LTRS',
            'wrapperID' => 18,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Trabajo Social',
            'clave' => 'LTRA',
            'wrapperID' => 18,
        ]);
        Carrera::create([
            'nombre' => 'Licenciatura en Trabajo Social',
            'clave' => 'TSO',
            'wrapperID' => 18,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Ingenieria Topográfica',
            'clave' => 'TOP',
            'wrapperID' => 19,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Bioética',
            'clave' => 'MBIO',
            'wrapperID' => 20,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Ciencia Política',
            'clave' => 'ICP',
            'wrapperID' => 21,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Ciencia Política',
            'clave' => 'MICP',
            'wrapperID' => 21,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Ciencia Política',
            'clave' => 'MACP',
            'wrapperID' => 21,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Ciencia Política',
            'clave' => 'MCPO',
            'wrapperID' => 21,
        ]);

        // Carrera::create([
        //     'nombre' => 'MAESTRIA EN GLOBAL POLITICS',
        //     'clave' => 'MGPT',
        // ]);

        Carrera::create([
            'nombre' => 'Maestría en Ciencias Sociales',
            'clave' => 'MICC',
            'wrapperID' => 22,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Ciencias Sociales',
            'clave' => 'RMSO',
            'wrapperID' => 22,
        ]);
        // Carrera::create([
        //     'nombre' => 'Maestría en Ciencias Sociales',
        //     'clave' => 'MICG',
        //     'wrapperID' => 22,
        // ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN CIENCIAS SOCIALES CON ORIENTACION',
            'clave' => 'MCSC',
            'wrapperID' => 23,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN CIENCIAS SOCIALES CON ORIENTACION',
            'clave' => 'MCSL',
            'wrapperID' => 23,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN CIENCIAS SOCIALES CON ORIENTACION',
            'clave' => 'MCSE',
            'wrapperID' => 23,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN CIENCIAS SOCIALES CON ORIENTACION',
            'clave' => 'MCSO',
            'wrapperID' => 23,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN CIENCIAS SOCIALES CON ORIENTACION',
            'clave' => 'MACS',
            'wrapperID' => 23,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Comunicación',
            'clave' => 'MICU',
            'wrapperID' => 24,
        ]);
        // Carrera::create([
        //     'nombre' => 'Maestría en Comunicación',
        //     'clave' => 'MCSC',
        //     'wrapperID' => 24,
        // ]);
        Carrera::create([
            'nombre' => 'Maestría en Comunicación',
            'clave' => 'RMCS',
            'wrapperID' => 24,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Comunicación',
            'clave' => 'MACU',
            'wrapperID' => 24,
        ]);
        // Carrera::create([
        //     'nombre' => 'Maestría en Comunicación',
        //     'clave' => 'MICN',
        //     'wrapperID' => 24,
        // ]);

        Carrera::create([
            'nombre' => 'Maestría en Derecho',
            'clave' => 'IDE',
            'wrapperID' => 25,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Derecho',
            'clave' => 'DEMA',
            'wrapperID' => 25,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Derecho',
            'clave' => 'MDRE',
            'wrapperID' => 25,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Derecho',
            'clave' => 'MIDR',
            'wrapperID' => 25,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DOC. DEL INGLES',
            'clave' => 'MDI',
            'wrapperID' => 26,
        ]);
        // Carrera::create([
        //     'nombre' => 'MAESTRIA EN DCHO CON ORIENTACION EN DERECHO C',
        //     'clave' => 'MCOA',
        //     'wrapperID' => 27,
        // ]);
    //
        Carrera::create([
            'nombre' => 'MAESTRIA EN DCHO CON ORIENTACION DERECHO CORPORATIVO',
            'clave' => 'MCOA',
            'wrapperID' => 28,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN DCHO CON ORIENTACION DERECHO CORPORATIVO',
            'clave' => 'MCOR',
            'wrapperID' => 28,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN DCHO CON ORIENTACION DERECHO CORPORATIVO',
            'clave' => 'MDCO',
            'wrapperID' => 28,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO AMBIENTAL',
            'clave' => 'MDAD',
            'wrapperID' => 29,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO ADMINISTRATIVO',
            'clave' => 'MDAS',
            'wrapperID' => 30,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CONSTITUCIONAL',
            'clave' => 'MDCA',
            'wrapperID' => 31,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CIVIL Y FAMILIAR',
            'clave' => 'MDCF',
            'wrapperID' => 32,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION EN CRMINOLOGIA',
            'clave' => 'MDCR',
            'wrapperID' => 33,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION EN DERECHO AGRARIO',
            'clave' => 'MDEA',
            'wrapperID' => 34,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO FISCAL',
            'clave' => 'MDF',
            'wrapperID' => 35,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION',
            'clave' => 'MDEE',
            'wrapperID' => 36,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION',
            'clave' => 'RMDE',
            'wrapperID' => 36,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION',
            'clave' => 'MDNA',
            'wrapperID' => 36,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO NOTARIAL',
            'clave' => 'MNOR',
            'wrapperID' => 37,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO NOTARIAL',
            'clave' => 'MDNF',
            'wrapperID' => 37,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO NEGOCIACIONES',
            'clave' => 'MDNS',
            'wrapperID' => 38,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO PENAL Y CRIMINALISTICA',
            'clave' => 'MDPC',
            'wrapperID' => 39,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIETACION EN ADMINISTRACION Y ',
            'clave' => 'MASP',
            'wrapperID' => 40,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN DERECHO CON ORIENTACION EN NEGOCIOS C',
            'clave' => 'MNES',
            'wrapperID' => 41,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Desarrollo Local y Territorio',
            'clave' => 'IDL',
            'wrapperID' => 42,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Desarrollo Local y Territorio',
            'clave' => 'MIDL',
            'wrapperID' => 42,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Enseñanza del Inglés como Lengua Extranjera (Programa Nacional de Posgrados de CONACYT)',
            'clave' => 'MLEE',
            'wrapperID' => 43,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Enseñanza del Inglés como Lengua Extranjera (Programa Nacional de Posgrados de CONACYT)',
            'clave' => 'IEI',
            'wrapperID' => 43,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Enseñanza del Inglés como Lengua Extranjera (Programa Nacional de Posgrados de CONACYT)',
            'clave' => 'MIEE',
            'wrapperID' => 43,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios críticos del lenguaje',
            'clave' => 'MECL',
            'wrapperID' => 44,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios de las Lenguas y Culturas Inglesas (Programa Nacional de Posgrados de CONACYT)',
            'clave' => 'MACI',
            'wrapperID' => 45,
        ]);

        // Carrera::create([
        //     'nombre' => 'Maestría en Estudios de las Lenguas y Culturas Inglesas (Programa Nacional de Posgrados de CONACYT)',
        //     'clave' => 'MLEI',
        //     'wrapperID' => 45,
        // ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios de Literatura Mexicana',
            'clave' => 'MIES',
            'wrapperID' => 46,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Estudios de Literatura Mexicana',
            'clave' => 'MIEL',
            'wrapperID' => 46,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Estudios de Literatura Mexicana',
            'clave' => 'MELM',
            'wrapperID' => 46,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios Filosóficos',
            'clave' => 'MAEF',
            'wrapperID' => 47,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios Filosóficos',
            'clave' => 'MIEF',
            'wrapperID' => 47,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios Francófonos: Pedagogía, Lingüística y Estudios Interculturales',
            'clave' => 'MFPL',
            'wrapperID' => 48,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Estudios Mesoamericanos',
            'clave' => 'MEME',
            'wrapperID' => 49,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Gestión y Desarrollo Social',
            'clave' => 'MIGT',
            'wrapperID' => 50,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Gestión y Desarrollo Social',
            'clave' => 'MGDS',
            'wrapperID' => 50,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Global Politics and Transpacific Studies',
            'clave' => 'MGPT',
            'wrapperID' => 51,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Historia de México',
            'clave' => 'MHME',
            'wrapperID' => 52,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Historia de México',
            'clave' => 'RMHM',
            'wrapperID' => 52,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Historia de México',
            'clave' => 'MIHM',
            'wrapperID' => 52,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Investigación Educativa',
            'clave' => 'INED',
            'wrapperID' => 53,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Lingüística Aplicada',
            'clave' => 'RMLA',
            'wrapperID' => 54,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Lingüística Aplicada',
            'clave' => 'MLIA',
            'wrapperID' => 54,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Lingüística Aplicada',
            'clave' => 'MLAP',
            'wrapperID' => 54,
        ]);
        Carrera::create([
            'nombre' => 'Maestría en Lingüística Aplicada',
            'clave' => 'MILA',
            'wrapperID' => 54,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Literaturas Interamericanas',
            'clave' => 'MLIE',
            'wrapperID' => 55,
        ]);

        Carrera::create([
            'nombre' => 'Maestría en Relaciones Internacionales de Gobiernos y Actores Locales (Programa Nacional de Posgrados del CONACYT)',
            'clave' => 'MRIG',
            'wrapperID' => 56,
        ]);

        Carrera::create([
            'nombre' => 'Maestría Interinstitucional en Deutsch als Fremdsprache: Estudios Interculturales de Lengua, Literatura y Cultura Alemanas',
            'clave' => 'MIDF',
            'wrapperID' => 57,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN CS FORENSES Y CRIMINOLOGIA',
            'clave' => 'MINO',
            'wrapperID' => 58,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN CS FORENSES Y CRIMINOLOGIA',
            'clave' => 'MARC',
            'wrapperID' => 58,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN CS FORENSES OR MED FORENSE',
            'clave' => 'MCMF',
            'wrapperID' => 59,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN CS FORENSES OR MED FORENSE',
            'clave' => 'MCCM',
            'wrapperID' => 59,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA CS FORENSE OR CRIMINALISTICA',
            'clave' => 'MCCR',
            'wrapperID' => 60,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA CS SOCIO MEDICAS',
            'clave' => 'MCNS',
            'wrapperID' => 61,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN LITERATURA COMPARADA',
            'clave' => 'MILC',
            'wrapperID' => 62,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN INVESTIGACION EN C',
            'clave' => 'RMID',
            'wrapperID' => 63,
        ]);
        Carrera::create([
            'nombre' => 'MAESTRIA EN INVESTIGACION EN C',
            'clave' => 'MIIC',
            'wrapperID' => 63,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN ESTUDIOS DE LAS LENGUAS',
            'clave' => 'MLEI',
            'wrapperID' => 64,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN FILOSOFIA',
            'clave' => 'RMFL',
            'wrapperID' => 65,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN ENSEÑANZA DE LA LENGUA',
            'clave' => 'RMLL',
            'wrapperID' => 66,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN LITERATURA DEL SIGLO XX',
            'clave' => 'RMLS',
            'wrapperID' => 67,
        ]);

        Carrera::create([
            'nombre' => 'MAESTRIA EN TRABAJO SOCIAL',
            'clave' => 'RMTS',
            'wrapperID' => 68,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Ciencia Política',
            'clave' => 'DCPO',
            'wrapperID' => 69,
        ]);
        Carrera::create([
            'nombre' => 'Doctorado en Ciencia Política',
            'clave' => 'DOCP',
            'wrapperID' => 69,
        ]);
        Carrera::create([
            'nombre' => 'Doctorado en Ciencia Política',
            'clave' => 'DCIP',
            'wrapperID' => 69,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Ciencias Sociales',
            'clave' => 'DUSO',
            'wrapperID' => 70,
        ]);
        Carrera::create([
            'nombre' => 'Doctorado en Ciencias Sociales',
            'clave' => 'DUCN',
            'wrapperID' => 70,
        ]);
        Carrera::create([
            'nombre' => 'Doctorado en Ciencias Sociales',
            'clave' => 'DCIS',
            'wrapperID' => 70,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Cognición y Aprendizaje',
            'clave' => 'DCOA',
            'wrapperID' => 71,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Derecho',
            'clave' => 'DCDR',
            'wrapperID' => 72,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Educación',
            'clave' => 'DUEU',
            'wrapperID' => 73,
        ]);
        Carrera::create([
            'nombre' => 'Doctorado en Educación',
            'clave' => 'DUED',
            'wrapperID' => 73,
        ]);
        Carrera::create([
            'nombre' => 'Doctorado en Educación',
            'clave' => 'DOED',
            'wrapperID' => 73,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Geografía y Ordenación Territorial',
            'clave' => 'DOGO',
            'wrapperID' => 74,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Geografía y Ordenación Territorial',
            'clave' => 'DGTL',
            'wrapperID' => 74,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Historia',
            'clave' => 'DOHI',
            'wrapperID' => 75,
        ]);
        Carrera::create([
            'nombre' => 'Doctorado en Historia',
            'clave' => 'DOCH',
            'wrapperID' => 75,
        ]);

        Carrera::create([
            'nombre' => 'Doctorado en Humanidades',
            'clave' => 'DOHU',
            'wrapperID' => 76,
        ]);

        Carrera::create([
            'nombre' => 'DOC EN CS SOCIO MEDICAS',
            'clave' => 'DCNS',
            'wrapperID' => 77,
        ]);

        Carrera::create([
            'nombre' => 'DOCTORADO INTERINSTITUCIONAL EN',
            'clave' => 'DUID',
            'wrapperID' => 78,
        ]);

        Carrera::create([
            'nombre' => 'DOCTORADO EN LETRAS',
            'clave' => 'DULE',
            'wrapperID' => 79,
        ]);

        Carrera::create([
            'nombre' => 'DOC EN ESTUDIOS LITERARIOS',
            'clave' => 'DULL',
            'wrapperID' => 80,
        ]);

        Carrera::create([
            'nombre' => 'ESPECIALIDAD EN LA ENSEÑANZA DEL ALEMAN',
            'clave' => 'XEL',
            'wrapperID' => 81,
        ]);
        Carrera::create([
            'nombre' => 'ESPECIALIDAD EN LA ENSEÑANZA DEL ALEMAN',
            'clave' => 'XEA',
            'wrapperID' => 81,
        ]);
        Carrera::create([
            'nombre' => 'ESPECIALIDAD EN LA ENSEÑANZA DEL ALEMAN',
            'clave' => 'RXEA',
            'wrapperID' => 81,
        ]);

        Carrera::create([
            'nombre' => 'ESPECIALIZACION EN EDUCADOR DE CALLE',
            'clave' => 'RXED',
            'wrapperID' => 82,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Relaciones Internacionales',
            'clave' => 'REIN',
            'wrapperID' => 83,
        ]);

        Carrera::create([
            'nombre' => 'Licenciatura en Relaciones Internacionales',
            'clave' => 'LRIN',
            'wrapperID' => 83,
        ]);

        Carrera::create([
            'nombre' => 'Lic En Ing. Topográfica',
            'clave' => 'LRIN',
            'wrapperID' => 84,
        ]);

    }
}
