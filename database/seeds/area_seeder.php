<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class area_seeder extends Seeder
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
		for ($i=21; $i < 50; $i++) {
    	\DB::table('area')->insert(array(
           	'nombre' => $faker->sentence($nbWords = 3, $variableNbWords = true),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
