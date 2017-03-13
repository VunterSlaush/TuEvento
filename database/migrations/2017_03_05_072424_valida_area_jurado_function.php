<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaAreaJuradoFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::unprepared("
            CREATE FUNCTION valida_area_jurado() RETURNS trigger
                LANGUAGE plpgsql
                AS $$
            BEGIN
            
                if ((SELECT id_jurado FROM area_jurado WHERE id_jurado=NEW.id_jurado
                        AND id_area=NEW.id_area)=NEW.id_jurado) then
                    RAISE EXCEPTION 'JURADO  YA TIENE ESTA AREA ASIGNADA';
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
       DB::unprepared("DROP FUNCTION valida_area_jurado()");
    }
}
