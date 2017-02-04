<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('califica', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
            $table->integer('id_propuesta');
            $table->integer('calificacion');
            $table->foreign('cedula')->references('cedula')->on('users');
            $table->foreign('id_propuesta')->references('id')->on('propuesta');
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
        Schema::dropIfExists('califica');
    }
}
