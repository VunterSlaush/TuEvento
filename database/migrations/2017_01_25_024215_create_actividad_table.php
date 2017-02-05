<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ponente');
            $table->integer('id_evento');
            $table->date('fecha');
            $table->string('titulo');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('resumen');
            $table->foreign('ponente')->references('cedula')->on('users');
            $table->foreign('id_evento')->references('id')->on('evento');
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
        Schema::dropIfExists('actividad');
    }
}
