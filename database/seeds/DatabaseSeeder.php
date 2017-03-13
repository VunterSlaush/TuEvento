<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('users_seeder');
        $this->call('tipo_actividad_seeder');
        $this->call('evento_seeder');
        $this->call('area_seeder');
        $this->call('actividad_seeder');
        $this->call('propuesta_seeder');
        $this->call('asiste_seeder');
        $this->call('comite_seeder');
        $this->call('jurado_seeder');
        $this->call('encuesta_seeder');
        $this->call('califica_satisfaccion_seeder');
        $this->call('presentador_seeder');
        $this->call('area_evento_seeder');
        $this->call('pregunta_seeder');
        $this->call('opcion_seeder');
        $this->call('tipo_actividad_evento_seeder');
        $this->call('area_jurado_seeder');
        $this->call('evalua_seeder');
        $this->call('respuesta_pregunta_seeder');
        $this->call('encuesta_pregunta_seeder');
    }
}
