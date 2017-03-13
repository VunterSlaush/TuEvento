<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class users_seeder extends Seeder
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
		for ($i=0; $i < 450; $i++) {
      	\DB::table('users')->insert(array(
      		'cedula' => $i+1,
      		//'password' => bcrypt('qwerty'),
          //Esta password viene de bcrypt ('qwerty'),
          //ejecutar la linea anterior consume ralentiza el proceso de seed la bd
          'password' => '$2y$10$OBJOnIe967F6n4ixr12QY.KL7L6OnC9xOlm1fNkcYh4.ZZ0XIKSrG',
      		'email' => $faker->unique()->email,
          'nombre' => $faker->name,
          'organizacion' => $faker->company,
          'created_at' => date('Y-m-d H:m:s'),
          'updated_at' => date('Y-m-d H:m:s')
      	));
  		}

    }
}
