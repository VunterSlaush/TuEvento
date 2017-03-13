<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class opcion_seeder extends Seeder
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
    	\DB::table('opcion')->insert(array(
    		'id_pregunta' => $faker->numberBetween($min = 1, $max = 10),
    		'opcion' => $faker->sentence($nbWords = 1, $variableNbWords = false),
    		'valor' => $faker->numberBetween($min = 1, $max = 10),    		
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
