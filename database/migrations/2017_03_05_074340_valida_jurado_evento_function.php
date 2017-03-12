<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaJuradoEventoFunction extends Migration
{
    /**
     * Run the migrations.
     * funcion para validar que un jurado no sea asignado al mismo evento
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION valida_jurado_evento() RETURNS trigger
                 LANGUAGE plpgsql
            AS $$
            BEGIN
            
                 if ((SELECT id_user FROM jurado WHERE id_user=NEW.id_user
                     AND id_evento=NEW.id_evento)=NEW.id_user) then
                     RAISE EXCEPTION 'usuario ya registrado como jurado en evento';
            
            else
                 return NEW;
            end if;
            
            --       RETURN NEW;
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
        DB::unprepared("DROP FUNCTION valida_jurado_evento()");
    }
}

