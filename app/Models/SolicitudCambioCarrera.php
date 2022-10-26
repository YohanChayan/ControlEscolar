<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCambioCarrera extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo(User::class);
    }

    protected $table = 'solicitudes_cambio_carreras';
}
