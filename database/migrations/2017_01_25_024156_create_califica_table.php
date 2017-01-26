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
            $table->string('cedula');
            $table->integer('idPropuesta');
            $table->integer('calificacion');
            $table->primary(array('cedula','idPropuesta'));
            $table->foreign('cedula')->references('cedula')->on('users');
            $table->foreign('idPropuesta')->references('id')->on('propuesta');
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
