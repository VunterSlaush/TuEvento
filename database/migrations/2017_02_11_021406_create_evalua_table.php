<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateEvaluaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evalua', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
            $table->foreign('cedula')->references('cedula')->on('users')->onDelete('cascade');
            $table->integer('id_propuesta');
            $table->foreign('id_propuesta')->references('id')->on('propuesta')->onDelete('cascade');
            $table->integer('id_encuesta');
            $table->foreign('id_encuesta')->references('id')->on('encuesta')->onDelete('cascade');
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
        Schema::dropIfExists('evalua');
    }
}
