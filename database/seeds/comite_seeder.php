<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class comite_seeder extends Seeder
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
    	\DB::table('comite')->insert(array(
    		'id_user' => $faker->unique()->numberBetween($min = 1, $max = 50),
    		'id_evento' => $faker->numberBetween($min = 1, $max = 7),    		
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
