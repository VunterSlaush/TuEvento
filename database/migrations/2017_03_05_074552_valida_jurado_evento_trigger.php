<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaJuradoEventoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
              CREATE TRIGGER valida_jurado_evento BEFORE INSERT OR UPDATE ON jurado FOR EACH ROW EXECUTE PROCEDURE valida_jurado_evento();

            ");
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_jurado_evento ON jurado");
    }
}
