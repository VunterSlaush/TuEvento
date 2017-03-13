<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class opcion_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $estandar = 2;
        $pregunta = 1;

        $faker = Faker::create();

		for ($i=1; $i <= 2000; $i++) {

            if ($i > $estandar){
                $pregunta++;
                $estandar = $estandar + 2;
            }

    	\DB::table('opcion')->insert(array(
            //Genera 2 opciones por cada pregunta
    		'id_pregunta' => $pregunta,
    		'opcion' => $faker->sentence($nbWords = 1, $variableNbWords = false),
    		'valor' => $faker->numberBetween($min = 1, $max = 10),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
