<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActaTitulacion extends Model
{
    use HasFactory;

    protected $table = 'actas_titulaciones';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
