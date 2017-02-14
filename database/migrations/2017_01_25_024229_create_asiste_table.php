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
            $table->string('codigo')->primary();
            $table->string('cedula');
            $table->integer('id_actividad');
            $table->boolean('asistio');
            $table->foreign('cedula')->references('cedula')->on('users')->onDelete('cascade');
            $table->foreign('id_actividad')->references('id')->on('actividad')->onDelete('cascade');
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
