<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaPresentadorActividadFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION valida_presentador_actividad() RETURNS trigger
                LANGUAGE plpgsql
                AS $$
            BEGIN
            
             if ((SELECT id_user FROM presentador WHERE id_user=NEW.id_user
                    AND id_actividad=NEW.id_actividad)=NEW.id_user) then
                    RAISE EXCEPTION 'USUARIO YA ESTA REGISTRADO COMO PRESENTADOR DE LA ACTIVIDAD';
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
        DB::unprepared("DROP FUNCTION valida_presentador_actividad()");
    }
}

