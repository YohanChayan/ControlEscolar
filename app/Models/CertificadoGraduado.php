<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoGraduado extends Model
{
    use HasFactory;

    protected $table = 'certificados_graduados';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
