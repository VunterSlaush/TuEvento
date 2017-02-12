<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoActividadEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_actividad_evento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo');
            $table->integer('id_evento');
            $table->integer('cant_maxima');
            $table->boolean('evaluable')->default(false);
            $table->foreign('id_tipo')->references('id')->on('tipo_actividad');
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
        Schema::dropIfExists('tipo_actividad_evento');
    }
}
