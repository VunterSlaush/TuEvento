<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class tipo_actividad_evento_seeder extends Seeder
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
		for ($i=0; $i < 10; $i++) {
    	\DB::table('tipo_actividad_evento')->insert(array(
    		'id_tipo' => $faker->numberBetween($min = 1, $max = 10),
    		'id_evento' => $faker->numberBetween($min = 1, $max = 7),
    		'cant_maxima' => $faker->numberBetween($min = 1, $max = 300),
    		'evaluable' => $faker->boolean,    		
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
