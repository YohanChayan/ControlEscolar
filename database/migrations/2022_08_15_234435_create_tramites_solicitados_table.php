<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesSolicitadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites_solicitados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folio'); //folio: se puede repetir pero por cada tipo de tramite es unico.
            $table->foreignId('student_id')->constrained('users','id');
            $table->foreignId('tramite_id')->constrained('tramites','id');
            $table->string('estatus')->default('Iniciado')->nullable();
            $table->string('categoria')->default('solicitado');
            $table->text('motivo')->nullable();
            $table->string('files')->nullable();

            $table->text('requerimientos_asignados')->nullable();

            $table->decimal('total_a_pagar', 10 ,2)->default(0)->nullable(); //solo aplica a constancia no adeudo
            $table->string('ultima_matricula_pagada')->default('')->nullable(); //solo aplica a constancia no adeudo
            $table->integer('matriculas_pendientes')->default('0')->nullable(); //solo aplica a constancia no adeudo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tramites_solicitados');
    }
}
