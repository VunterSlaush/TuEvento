<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class area_evento_seeder extends Seeder
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
		for ($i=0; $i < 40; $i++) {
    	\DB::table('area_evento')->insert(array(
    		'id_area' => $faker->unique()->numberBetween($min = 1, $max = 50),
    		'id_evento' => $faker->unique()->numberBetween($min = 1, $max = 50),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
