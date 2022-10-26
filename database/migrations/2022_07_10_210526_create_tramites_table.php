<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tramite');
            $table->decimal('monto',10,2);
            $table->text('requerimientos'); //delimitador '|'
            $table->string('aviso')->nullable()->default('Sin aviso');
            $table->string('referencia')->default('9 000 000 2775');
            $table->string('formato')->nullable()->default('formato_certificados_y_actasTitulacion'); //Path view (no modificar)
            $table->string('modalidad')->nullable()->default('Presencial'); //
            $table->boolean('disponible')->nullable()->default(true); //

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
        Schema::dropIfExists('tramites');
    }
}
