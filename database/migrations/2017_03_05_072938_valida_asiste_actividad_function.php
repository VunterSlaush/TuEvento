<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaAsisteActividadFunction extends Migration
{
    /**
     * Run the migrations.
     *funcion para validar que un usuario no este registrado 2 veces en una asistencia para una actividad
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION valida_asiste_actividad() RETURNS trigger
                LANGUAGE plpgsql
                AS $$
            BEGIN
            
                 if ((SELECT cedula FROM asiste WHERE cedula=NEW.cedula
                    AND id_actividad=NEW.id_actividad)=NEW.cedula) then
                    RAISE EXCEPTION 'USUARIO YA ESTA REGISTRADO EN ASISTENCIA DE ACTIVIDAD';
            --Valida que el usuario no vuelva a ser registrado para un mismo evento
            else
                  return NEW; -- Retorna el Registro
            end if;
            
            
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
        DB::unprepared("DROP FUNCTION valida_asiste_actividad()");
    }
}

