<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuesta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('autor');
            $table->integer('id_evento');
            $table->integer('id_area');
            $table->integer('id_tipo');
            $table->string('titulo');
            $table->string('adjunto');
            $table->string('demanda');
            $table->string('descripcion');
            $table->integer('duracion');
            $table->foreign('autor')->references('cedula')->on('users');
            $table->foreign('id_evento')->references('id')->on('evento');
            $table->foreign('id_area')->references('id')->on('area');
            $table->foreign('id_tipo')->references('id')->on('tipo_actividad');
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
        Schema::dropIfExists('propuesta');
    }
}
