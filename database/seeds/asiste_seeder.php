<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class asiste_seeder extends Seeder
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
		for ($i=0; $i < 100; $i++) {
    	\DB::table('asiste')->insert(array(
    		'codigo' => $faker->unique()->ean8,
    		'cedula' => $faker->unique()->numberBetween($min = 1, $max = 450),
    		'id_actividad' => $faker->numberBetween($min = 1, $max = 400),
    		'asistio' => $faker->boolean,    	
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
