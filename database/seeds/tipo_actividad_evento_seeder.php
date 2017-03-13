<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class tipo_actividad_evento_seeder extends Seeder
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
        
        $estandar = 4;
        $evento = 1;

		for ($i=1; $i <= 200; $i++) {
            
            if ($i > $estandar){
                $evento++;
                $estandar = $estandar + 4;
            }

    	\DB::table('tipo_actividad_evento')->insert(array(
    		'id_tipo' => $faker->numberBetween($min = 1, $max = 20),
            //Genera 4 tipos de actividad por evento
    		'id_evento' => $evento,
    		'cant_maxima' => $faker->numberBetween($min = 30, $max = 500),
    		'evaluable' => $faker->boolean,
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
