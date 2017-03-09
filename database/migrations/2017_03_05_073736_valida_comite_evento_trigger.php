<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaComiteEventoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
              CREATE TRIGGER valida_comite_evento BEFORE INSERT OR UPDATE ON comite FOR EACH ROW EXECUTE PROCEDURE valida_comite_evento();
            ");
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_comite_evento ON comite");
    }
}
