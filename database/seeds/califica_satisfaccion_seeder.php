<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class califica_satisfaccion_seeder extends Seeder
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
		for ($i=0; $i < 20; $i++) {
    	\DB::table('califica_satisfaccion')->insert(array(
    		'id_actividad' => $faker->numberBetween($min = 1, $max = 40),
    		'id_encuesta' => $faker->numberBetween($min = 1, $max = 20),
    		'id_user' => $faker->numberBetween($min = 1, $max = 50),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
