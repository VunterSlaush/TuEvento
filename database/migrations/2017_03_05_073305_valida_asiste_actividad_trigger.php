<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaAsisteActividadTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
            DB::unprepared("
              CREATE TRIGGER valida_asiste_actividad BEFORE INSERT OR UPDATE ON asiste FOR EACH ROW EXECUTE PROCEDURE valida_asiste_actividad();
            ");
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_asiste_actividad ON asiste");
    }
}