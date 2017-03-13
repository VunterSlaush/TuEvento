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
		for ($i=0; $i < 380; $i++) {
    	\DB::table('presentador')->insert(array(
    		'id_actividad' => $faker->unique()->numberBetween($min = 1, $max = 400),
    		'id_user' => $faker->numberBetween($min = 1, $max = 450),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
