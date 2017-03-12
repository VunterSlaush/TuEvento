<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValidaHorarioFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * evita el solapamiento de las actividades para el horario del usuario
     * @return void
     */
    public function up()
    {
         DB::unprepared("
                 CREATE FUNCTION public.valida_horario() RETURNS trigger
                 LANGUAGE plpgsql
                 AS $$
                 DECLARE
                    r asiste%rowtype;
                    fch       actividad.fecha%type;
                    hra_ini   actividad.hora_inicio%type;
                    hra_f     actividad.hora_fin%type;

                 BEGIN

                    fch     = (SELECT fecha FROM actividad where id=NEW.id_actividad);
                    hra_ini = (SELECT hora_inicio FROM actividad where id=NEW.id_actividad);
                     hra_f   = (SELECT hora_fin    FROM actividad where id=NEW.id_actividad);

                 FOR r IN SELECT * FROM asiste
                 WHERE cedula=NEW.cedula AND asiste.asistio = false
                 LOOP

                    IF ((SELECT fecha FROM actividad WHERE id=r.id_actividad)=fch) THEN  --valida que la fecha sea igual

                        IF(((SELECT hora_inicio FROM actividad WHERE id=r.id_actividad)>hra_f) OR (SELECT hora_fin FROM actividad WHERE id=r.id_actividad)<hra_ini) THEN
                             --exito el horario no entra en solapamiento
                         ELSE

                            RAISE EXCEPTION 'ERROR CHOQUE DE HORAS AL ASIGNAR ACTIVIDAD';
                         END IF;

                         -- RAISE NOTICE 'exito en el horario ';
                    END IF;

                 END LOOP;
                 RETURN NEW;
                 END;
                 $$
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("DROP FUNCTION valida_horario()");
    }
}
