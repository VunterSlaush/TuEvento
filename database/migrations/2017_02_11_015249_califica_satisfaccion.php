<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CalificaSatisfaccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('califica_satisfaccion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_actividad');
            $table->integer('id_encuesta');
            $table->string('id_user');
            $table->foreign('id_user')->references('cedula')->on('users')->onDelete('cascade');
            $table->foreign('id_actividad')->references('id')->on('actividad')->onDelete('cascade');
            $table->foreign('id_encuesta')->references('id')->on('encuesta')->onDelete('cascade');
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
        Schema::drop('califica_satisfaccion');
    }
}
