<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuesta', function (Blueprint $table) {
            $table->integer('id');
            $table->string('autor');
            $table->integer('idEvento');
            $table->string('adjunto');
            $table->string('demanda');
            $table->primary('id');
            $table->foreign('autor')->references('cedula')->on('usuarios');
            $table->foreign('idEvento')->references('id')->on('evento');
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
        Schema::dropIfExists('propuesta');
    }
}
