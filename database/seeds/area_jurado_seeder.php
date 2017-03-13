<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class area_jurado_seeder extends Seeder
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
		for ($i=0; $i < 30; $i++) {
    	\DB::table('area_jurado')->insert(array(
    		'id_area' => $faker->unique()->numberBetween($min = 1, $max = 30),
    		'id_jurado' => $faker->numberBetween($min = 1, $max = 150),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
