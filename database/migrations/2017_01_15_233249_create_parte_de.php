<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParteDe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('parte_de', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_actividad');
          $table->string('id_user');
          $table->foreign('id_actividad')->references('id')->on('actividad');
          $table->foreign('id_user')->references('cedula')->on('users');
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
