<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateOpcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pregunta');
            $table->string('opcion');
            $table->integer('valor');
            $table->foreign('id_pregunta')->references('id')->on('pregunta')->onDelete('cascade');
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
        Schema::drop('opcion');
    }
}
