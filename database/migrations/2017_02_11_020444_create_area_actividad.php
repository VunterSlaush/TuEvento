<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('area_actividad', function (Blueprint $table)
      {
        $table->increments('id');
        $table->integer('id_area');
        $table->integer('id_actividad');
        $table->foreign('id_area')->references('id')->on('area');
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
        Schema::drop('area_actividad');
    }
}
