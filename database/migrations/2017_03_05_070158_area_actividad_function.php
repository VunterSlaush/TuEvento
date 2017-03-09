<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AreaActividadFunction extends Migration
{
    /**
     * Run the migrations.
     * Funcion para validar que el area de una actividad no se repita.
     * @return void
     */
    public function up()
    {
        
        DB::unprepared("
            CREATE FUNCTION valida_area_actividad() RETURNS trigger
                LANGUAGE plpgsql
                AS $$
            BEGIN
            
                 if ((SELECT id_actividad FROM area_actividad WHERE id_actividad=NEW.id_actividad
                    AND id_area=NEW.id_area)=NEW.id_actividad) then
                    RAISE EXCEPTION 'ACTIVIDAD  YA TIENE ESTA AREA ASIGNADA';
            
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
        DB::unprepared("DROP FUNCTION valida_area_actividad()");
    }
}
