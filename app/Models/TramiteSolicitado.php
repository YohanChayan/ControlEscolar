<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TramiteSolicitado extends Model
{
    use HasFactory;

    protected $table = 'tramites_solicitados';

    public function tramite(){
        return $this->belongsTo(Tramite::class);
    }

    protected $fillable = [
        'user_id',
        'tramite_id',
        'estatus',
        'estadistico',
        'requerimientos',
        'folio',
    ];

}
