<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class pregunta_seeder extends Seeder
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
        
        $estandar = 20;
        $evento = 1;    

		for ($i=1; $i <= 1000; $i++) {       

            if ($i > $estandar){
                $evento++;
                $estandar = $estandar + 20;
            }

    	\DB::table('pregunta')->insert(array(
    		'pregunta' => $faker->text($maxNbChars = 200),
            //Genera 20 preguntas por evento
    		'id_evento' => $evento,
           	'created_at' => date('Y-m-d H:m:s'),
           	'updated_at' => date('Y-m-d H:m:s')
    	));
		}
    }
}