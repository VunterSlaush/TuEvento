<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class encuesta_seeder extends Seeder
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

    	\DB::table('encuesta')->insert(array(
    		'tipo' => $faker->sentence($nbWords = 1, $variableNbWords = true),
    		'nombre' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            //Se generan 3 encuestas por evento
    		'id_evento' => $evento,
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
