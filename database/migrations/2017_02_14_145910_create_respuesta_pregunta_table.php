<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaPreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('respuesta_pregunta', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_opcion');
          $table->integer('id_evalua')->nullable();
          $table->integer('id_califica')->nullable();
          $table->string('tipo');
          $table->foreign('id_opcion')->references('id')->on('opcion')->onDelete('cascade');
          $table->foreign('id_evalua')->references('id')->on('evalua')->onDelete('cascade');
          $table->foreign('id_califica')->references('id')->on('califica_satisfaccion')->onDelete('cascade');
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
        Schema::dropIfExists('respuesta_pregunta');
    }
}
