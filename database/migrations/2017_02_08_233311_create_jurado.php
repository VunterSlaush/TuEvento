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
          $table->foreign('id_user')->references('cedula')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('jurado');
    }
}
