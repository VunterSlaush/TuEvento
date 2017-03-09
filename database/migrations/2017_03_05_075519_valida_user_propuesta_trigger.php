<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaUserPropuestaTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
              CREATE TRIGGER valida_user_evalua_propuesta BEFORE INSERT OR UPDATE ON evalua FOR EACH ROW EXECUTE PROCEDURE valida_user_evalua_propuesta();


            ");
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER valida_user_evalua_propuesta ON evalua");
    }
}