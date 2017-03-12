<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaPresentadorActividadTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
              CREATE TRIGGER valida_presentador_actividad BEFORE INSERT OR UPDATE ON presentador FOR EACH ROW EXECUTE PROCEDURE valida_presentador_actividad();

            ");
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_presentador_actividad ON presentador");
    }
}