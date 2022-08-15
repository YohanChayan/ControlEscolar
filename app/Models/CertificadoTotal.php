<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoTotal extends Model
{
    use HasFactory;

    protected $table = 'certificados_totales';


    public function user(){
        return $this->belongsTo(User::class);
    }
}
