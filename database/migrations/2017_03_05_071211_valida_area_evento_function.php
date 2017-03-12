<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaAreaEventoFunction extends Migration
{
    /**
     * Run the migrations.
     *Funcion para validar que el area no se repita para un evento
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION valida_area_evento() RETURNS trigger
              LANGUAGE plpgsql
                AS $$
            BEGIN
            
                 if ((SELECT id_evento FROM area_evento WHERE id_evento=NEW.id_evento
                     AND id_area=NEW.id_area)=NEW.id_evento) then
                 RAISE EXCEPTION 'EVENTO YA TIENE ESTA AREA ASIGNADA';
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
       DB::unprepared("DROP FUNCTION valida_area_evento()");
    }
}
