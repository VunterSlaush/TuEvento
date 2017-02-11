<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoActividadActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_actividad_actividad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo');
            $table->integer('id_propuesta');
            $table->foreign('id_tipo')->references('id')->on('tipo_actividad');
            $table->foreign('id_actividad')->references('id')->on('actividad');
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
        Schema::dropIfExists('tipo_actividad_actividad');
    }
}
