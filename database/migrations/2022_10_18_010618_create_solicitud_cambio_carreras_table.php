<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudCambioCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_cambio_carreras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users','id');
            $table->string('new_clave_carrera',100);
            $table->string('estatus',100)->default('pendiente'); //pendiente, aprobado, rechazado.
            $table->string('new_nombre_carrera');
            $table->integer('answer')->default(0); // 1:solicitado , 2: admin:answer, 3: seen by student
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
        Schema::dropIfExists('solicitud_cambio_carreras');
    }
}
