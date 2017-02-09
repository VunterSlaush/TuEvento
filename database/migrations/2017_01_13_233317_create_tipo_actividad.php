<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tipo_actividad', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_evento');
          $table->integer('id_area');
          $table->integer('cant_max');
          $table->string('nombre');
          $table->boolean('evaluable');
          $table->foreign('id_evento')->references('id')->on('evento');
          $table->foreign('id_area')->references('id')->on('area');
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
        //
    }
}
