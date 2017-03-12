<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaHorarioTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
             
                CREATE TRIGGER valida_horario BEFORE INSERT ON asiste
                FOR EACH ROW EXECUTE PROCEDURE valida_horario();
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("DROP TRIGGER valida_horario ON asiste");
    }
}
