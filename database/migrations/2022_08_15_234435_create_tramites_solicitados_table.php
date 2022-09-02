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
            $table->foreignId('user_id')->constrained(); // ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tramite_id')->constrained('tramites', 'id');
            $table->string('estatus', 150)->default('Recepción de tramite recibido en CE');
            $table->tinyInteger('estadistico')->default(1);
            $table->unsignedBigInteger('folio'); //folio: se puede repetir pero por cada tipo de tramite es distinto.

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
