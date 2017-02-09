<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('jurado', function (Blueprint $table) {
          $table->increments('id');
          $table->string('id_user');
          $table->integer('id_evento');
          $table->integer('id_area');
          $table->foreign('id_user')->references('cedula')->on('users');
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
