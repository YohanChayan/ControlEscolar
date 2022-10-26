<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TramiteEstatus extends Model
{
    use HasFactory;

    protected $table = 'tramites_estatus';

    public function solicitado(){
        return $this->hasOne(TramiteSolicitado::class);
    }
}
