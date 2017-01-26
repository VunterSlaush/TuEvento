<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsisteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asiste', function (Blueprint $table) {
            $table->string('cedula');
            $table->integer('idActividad');
            $table->boolean('asistio');
            $table->string('codigo');
            $table->primary(array('cedula','idActividad'));
            $table->foreign('cedula')->references('cedula')->on('users');
            $table->foreign('idActividad')->references('id')->on('actividad');
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
        Schema::dropIfExists('asiste');
    }
}
