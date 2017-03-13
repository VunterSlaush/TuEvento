<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class propuesta_seeder extends Seeder
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
    	\DB::table('propuesta')->insert(array(
    		'autor' => $faker->numberBetween($min = 1, $max = 50),
    		'id_evento' => $faker->numberBetween($min = 1, $max = 7),
    		'id_area' => $faker->numberBetween($min = 1, $max = 8),
    		'id_tipo' => $faker->numberBetween($min = 1, $max = 10),
    		'titulo' => $faker->sentence($nbWords = 4, $variableNbWords = true),
    		'demanda' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    		'descripcion' => $faker->sentence($nbWords = 8, $variableNbWords = true),    	
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
