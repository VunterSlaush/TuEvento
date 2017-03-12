<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaAreaJuradoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared("
            CREATE TRIGGER valida_area_jurado BEFORE INSERT OR UPDATE ON area_jurado FOR EACH ROW EXECUTE PROCEDURE valida_area_jurado();

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_area_jurado ON area_jurado");
    }
}
