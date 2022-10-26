<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    public function tramitesolicitados(){
        return $this->hasMany(TramiteSolicitado::class);
    }

    protected $fillable = [
        'nombre_tramite',
        'monto',
        'requerimientos',
        'aviso',
    ];

    public function getModality($reqs)
    {
        $arr = explode('|', $reqs);

        $virtual = [];
        $presencial = [];
        foreach($arr as $item){
            $indicator = substr($item,0,1);

            if($indicator == '_')
                array_push($virtual, $item);
            else
                array_push($presencial, $item);
        }

        $countPresencial = count($presencial);
        $countVirtual = count($virtual);

        $answer = 'Presencial';
        if($countPresencial == 0)
            $answer = 'Virtual';
        else if($countPresencial > 0 && $countVirtual > 0)
            $answer = 'Ambos';

        return $answer;

    }
}
