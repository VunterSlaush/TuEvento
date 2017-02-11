<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_encuesta');
            $table->foreign('id_encuesta')->references('encuesta')->on('id');
            $table->string('pregunta');
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
        Schema::drop('pregunta');
    }
}
