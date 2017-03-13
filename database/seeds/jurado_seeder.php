<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class jurado_seeder extends Seeder
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

        $estandar = 3;
        $evento = 1;

		for ($i=1; $i <= 150; $i++) {

            if ($i > $estandar){
                $evento++;
                $estandar = $estandar + 3;
            }

    	\DB::table('jurado')->insert(array(
    		'id_user' => $faker->unique()->numberBetween($min = 1, $max = 450),
            //Genera 3 jurados por evento
    		'id_evento' => $evento,
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
