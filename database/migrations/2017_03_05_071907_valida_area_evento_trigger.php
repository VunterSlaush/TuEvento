<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaAreaEventoTrigger extends Migration
{
    /**
     * Run the migrations.
     *CREATE TRIGGER valida_area_evento BEFORE INSERT OR UPDATE ON area_evento FOR EACH ROW EXECUTE PROCEDURE valida_area_evento();

     * @return void
     */
    public function up()
    {
         DB::unprepared("
            CREATE TRIGGER valida_area_evento BEFORE INSERT OR UPDATE ON area_evento FOR EACH ROW EXECUTE PROCEDURE valida_area_evento();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_area_evento ON area_evento");
    }
}
