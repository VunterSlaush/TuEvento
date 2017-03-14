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

		for ($i=1; $i <= 450; $i++) {

    	\DB::table('area_evento')->insert(array(
    		'id_area' => $i,
    		'id_evento' => $i,
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
