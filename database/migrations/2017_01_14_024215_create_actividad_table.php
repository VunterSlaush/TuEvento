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
            $table->increments('id');
            $table->date('fecha');
            $table->string('titulo');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('resumen');
            $table->integer('id_actividad');
            $table->integer('id_evento');
            $table->string('id_user');
            $table->foreign('id_user')->references('cedula')->on('users')->onDelete('cascade');
            $table->foreign('id_evento')->references('id')->on('evento')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::drop('actividad');
    }
}
