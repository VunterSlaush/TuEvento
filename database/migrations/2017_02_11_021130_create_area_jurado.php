<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('area_jurado', function (Blueprint $table)
      {
        $table->increments('id');
        $table->integer('id_area');
        $table->integer('id_jurado');
        $table->foreign('id_area')->references('id')->on('area');
        $table->foreign('id_jurado')->references('id')->on('jurado');
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
        Schema::drop('area_jurado');
    }
}
