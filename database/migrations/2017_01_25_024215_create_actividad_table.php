<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad', function (Blueprint $table) {
            $table->integer('id')->increments();
            $table->string('ponente');
            $table->integer('evento');
            $table->date('fecha');
            $table->string('titulo');
            $table->timestamp('hora_inicio');
            $table->timestamp('hora_fin');
            $table->string('resumen');
            $table->primary('id');
            $table->foreign('ponente')->references('cedula')->on('users');
            $table->foreign('evento')->references('id')->on('evento');
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
        Schema::dropIfExists('actividad');
    }
}
