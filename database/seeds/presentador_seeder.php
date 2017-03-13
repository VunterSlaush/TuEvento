<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class presentador_seeder extends Seeder
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
    	\DB::table('presentador')->insert(array(
    		'id_actividad' => $faker->numberBetween($min = 1, $max = 40),
    		'id_user' => $faker->numberBetween($min = 1, $max = 50),    		
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
