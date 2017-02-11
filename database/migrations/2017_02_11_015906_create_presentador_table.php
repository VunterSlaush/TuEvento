<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePresentadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentador', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_actividad');
            $table->string('id_user');
            $table->foreign('id_user')->references('cedula')->on('users');
            $table->foreign('id_actividad')->references('id')->on('actividad');
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
        Schema::drop('presentador');
    }
}
