<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class respuesta_pregunta_seeder extends Seeder
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
		for ($i=0; $i < 700; $i++) {
    	\DB::table('respuesta_pregunta')->insert(array(
    		'id_opcion' => $faker->numberBetween($min = 1, $max = 2000),
    		'id_evalua' => $faker->numberBetween($min = 1, $max = 200),
    		'id_califica' => $faker->numberBetween($min = 1, $max = 200),
    		'tipo' => $faker->text($maxNbChars = 200),    		
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
