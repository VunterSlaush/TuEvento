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

		for ($i=1; $i <= 50; $i++) {

    	\DB::table('area_evento')->insert(array(
    		'id_area' => $faker->numberBetween($min = 1, $max = 30),
            //Genera 1 areas por evento
    		'id_evento' => $i,
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
