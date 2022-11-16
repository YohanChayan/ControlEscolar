<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('none'); //admin, coordinador, student, noVerified
            $table->string('apellidos')->default('');
            $table->string('codigo')->unique();
            $table->string('clave_carrera')->nullable();
            $table->string('nombre_carrera')->nullable();
            $table->string('ciclo_admision')->nullable();
            $table->integer('answer_dataIsWrong')->default(0); //1: [admin], -1: [student], 0: [no answer]
            $table->string('hasToFix')->default(''); //delimitado por |
            $table->string('telefono', 25)->default('');
            $table->string('estatus', 25)->default('Pendiente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
