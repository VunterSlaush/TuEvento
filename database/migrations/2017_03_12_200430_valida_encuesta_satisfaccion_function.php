<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaEncuestaSatisfaccionFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE FUNCTION valida_encuesta_satisfaccion() RETURNS trigger
              LANGUAGE plpgsql
                AS $$
            BEGIN
            
                 if ((SELECT tipo FROM encuesta WHERE id_evento=NEW.id_evento
                     AND tipo='satisfaccion')=NEW.tipo) then
                 RAISE EXCEPTION 'EVENTO YA TIENE ENCUESTA DE SATISFACCION ASIGNADA';
                    --valida que el evento no vuelva a ser asignado a una misma encuesta de satisfaccion
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
        DB::unprepared("DROP FUNCTION valida_encuesta_satisfaccion()");
    }
}
