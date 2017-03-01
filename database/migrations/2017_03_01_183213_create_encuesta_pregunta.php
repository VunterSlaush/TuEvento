<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaPregunta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('encuesta_pregunta', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_pregunta');
          $table->integer('id_encuesta');
          $table->foreign('id_pregunta')->references('id')->on('pregunta')->onDelete('cascade');
          $table->foreign('id_encuesta')->references('id')->on('encuesta')->onDelete('cascade');
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
        Schema::dropIfExists('encuesta_pregunta');
    }
}
