<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class encuesta_pregunta_seeder extends Seeder
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
    	\DB::table('encuesta_pregunta')->insert(array(
    		'id_pregunta' => $faker->numberBetween($min = 1, $max = 10),
    		'id_encuesta' => $faker->numberBetween($min = 1, $max = 20),    		
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
