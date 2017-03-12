<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaEncuestaSatisfaccionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
              CREATE TRIGGER valida_encuesta_satisfaccion BEFORE INSERT OR UPDATE ON encuesta FOR EACH ROW EXECUTE PROCEDURE valida_encuesta_satisfaccion();


            ");
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_encuesta_satisfaccion ON encuesta");
    }
}
