<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AreaActividadTrigger extends Migration
{
    /**
     * Run the migrations.
     * trigger para hacer el llamado a la funcion que valida los datos en la tabla area_actividad
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER valida_area_actividad BEFORE INSERT OR UPDATE ON area_actividad FOR EACH ROW EXECUTE PROCEDURE valida_area_actividad();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_area_actividad ON area_actividad");
    }
}
