<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('area_evento', function (Blueprint $table)
      {
        $table->increments('id');
        $table->integer('id_area');
        $table->integer('id_evento');
        $table->foreign('id_area')->references('id')->on('area')->onDelete('cascade');
        $table->foreign('id_evento')->references('id')->on('evento')->onDelete('cascade');
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
      Schema::drop('area_evento');
    }
}
