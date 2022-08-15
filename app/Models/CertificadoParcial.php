<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoParcial extends Model
{
    use HasFactory;

    protected $table = 'certificados_parciales';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
