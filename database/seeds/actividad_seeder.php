<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class actividad_seeder extends Seeder
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
        
        $estandar = 8;
        $evento = 1;

		for ($i=1; $i <= 400; $i++) {
            
            if ($i > $estandar){
                $evento++;
                $estandar = $estandar + 8;
            }

    	\DB::table('actividad')->insert(array(
    		'fecha' => $faker->dateTimeThisMonth->format('Y-m-d'),
    		'titulo' => $faker->sentence($nbWords = 4, $variableNbWords = true),
    		'hora_inicio' => $faker->time($format = 'H:i:s', $max = 'now'),
    		'hora_fin' => $faker->time($format = 'H:i:s', $max = 'now'),
    		'resumen' => $faker->sentence($nbWords = 10, $variableNbWords = true),    		
            //Genera 8 actividades por evento
            'id_evento' => $evento,
    		'tipo' => $faker->numberBetween($min = 1, $max = 20),
    		'area' => $faker->numberBetween($min = 1, $max = 30),
    		'id_user' => $faker->numberBetween($min = 1, $max = 450),
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}
