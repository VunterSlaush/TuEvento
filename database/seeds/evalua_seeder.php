<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class evalua_seeder extends Seeder
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
		for ($i=0; $i < 200; $i++) {
    	\DB::table('evalua')->insert(array(
    		'cedula' => $faker->numberBetween($min = 1, $max = 450),
    		'id_propuesta' => $faker->numberBetween($min = 1, $max = 150),
    		'id_encuesta' => $faker->numberBetween($min = 1, $max = 150),    		
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
