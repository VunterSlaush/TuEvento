<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class propuesta_seeder extends Seeder
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

		for ($i=1; $i <= 1350; $i++) {

            if ($i > $estandar){
                $evento++;
                $estandar = $estandar + 3;
            }

    	\DB::table('propuesta')->insert(array(
    		'autor' => $faker->numberBetween($min = 1, $max = 450),
            //Se generan 3 propuestas por evento
    		'id_evento' => $evento,
    		'id_area' => $faker->numberBetween($min = 1, $max = 150),
    		'id_tipo' => $faker->numberBetween($min = 1, $max = 20),
            'adjunto' => $faker->imageUrl($width = 640, $height = 480),
    		'titulo' => $faker->sentence($nbWords = 4, $variableNbWords = true),
    		'demanda' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    		'descripcion' => $faker->sentence($nbWords = 8, $variableNbWords = true),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
