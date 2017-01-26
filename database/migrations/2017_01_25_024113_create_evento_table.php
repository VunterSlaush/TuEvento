<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->integer('id')->increments();
            $table->string('creador');
            $table->string('nombre');
            $table->string('lugar');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin');
            $table->primary('id');
            $table->foreign('creador')->references('cedula')->on('users');
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
        Schema::dropIfExists('evento');
    }
}
