<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class evento_seeder extends Seeder
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
		for ($i=0; $i < 50; $i++) {
    	\DB::table('evento')->insert(array(
    		'creador' => $faker->numberBetween($min = 1, $max = 50),
    		'nombre' => $faker->sentence($nbWords = 4, $variableNbWords = true),
    		'lugar' => $faker->state,
    		'fecha_inicio' => $faker->date($format = 'Y-m-d', $max = 'now'),
    		'fecha_fin' => $faker->date($format = 'Y-m-d', $max = 'now'),
    		'estado' => $faker->randomElement(['inscripciones','iniciado','finalizado']),
    		'imagen' => $faker->imageUrl($width = 640, $height = 480),
    		'certificado_por_actividad' => $faker->boolean,
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
