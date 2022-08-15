<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function GetMontoByTramite($name_procedure){
        if($name_procedure == 'Certificado parcial de estudio'){
            return '$91.00';
        }
        if($name_procedure == 'Certificado total de estudio'){
            return '$91.00';
        }
        if($name_procedure == 'Certificado de graduado'){
            return '$218.00';
        }
        if($name_procedure == 'Acta de titulacion'){
            return '$91.00';
        }
    }

    public function GetFormatoByTramite($name_procedure){
        if($name_procedure == 'Certificado parcial de estudio'){
            // return '$91.00';
        }
        if($name_procedure == 'Certificado total de estudio'){
            // return '$91.00';
        }
        if($name_procedure == 'Certificado de graduado'){
            // return '$218.00';
        }
        if($name_procedure == 'Acta de titulacion'){
            // return '$91.00';
        }
    }
}
