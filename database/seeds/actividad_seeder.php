<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class actividad_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
		for ($i=0; $i < 40; $i++) {
    	\DB::table('actividad')->insert(array(
    		'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
    		'titulo' => $faker->sentence($nbWords = 4, $variableNbWords = true),
    		'hora_inicio' => $faker->time($format = 'H:i:s', $max = 'now'),
    		'hora_fin' => $faker->time($format = 'H:i:s', $max = 'now'),
    		'resumen' => $faker->sentence($nbWords = 10, $variableNbWords = true),
    		'id_evento' => $faker->numberBetween($min = 1, $max = 50),
    		'tipo' => $faker->numberBetween($min = 1, $max = 10),
    		'area' => $faker->numberBetween($min = 1, $max = 8),
    		'id_user' => $faker->numberBetween($min = 1, $max = 50),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
