<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaComiteEventoFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION valida_comite_evento() RETURNS trigger
                LANGUAGE plpgsql
            AS $$
            BEGIN
            
                    if ((SELECT id_user FROM comite WHERE id_user=NEW.id_user
                      AND id_evento=NEW.id_evento)=NEW.id_user) then
                        RAISE EXCEPTION 'USUARIO YA ESTA REGISTRADO';
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
        DB::unprepared("DROP FUNCTION valida_comite_evento()");
    }
}

