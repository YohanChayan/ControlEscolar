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
            $table->string('role')->default('none');
            $table->string('apellidos')->default('');
            $table->string('codigo')->unique();
            $table->foreignId('carrera_id')->nullable()->constrained('carreras');
            $table->string('clave_carrera')->nullable();
            $table->string('ciclo_admision')->nullable();
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
