<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaUserPropuestaFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared("
            CREATE FUNCTION valida_user_evalua_propuesta() RETURNS trigger
             LANGUAGE plpgsql
             AS $$
            BEGIN
                 IF ((SELECT cedula FROM evalua WHERE cedula=NEW.cedula
                     AND id_propuesta=NEW.id_propuesta)=NEW.cedula) then
                     RAISE EXCEPTION 'PORPUESTA YA FUE EVALUADA POR ESTE USUARIO: %', NEW.cedula;
            --valida que el evento no vuelva a ser asignado a una misma area   
            else
                 return NEW; -- Retorna el Registro   
            end if;
            -- valida que el area no se repita para un evento
            END;
            $$;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION valida_user_evalua_propuesta()");
    }
}