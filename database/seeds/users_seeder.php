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
		for ($i=0; $i <= 50; $i++) {
      	\DB::table('users')->insert(array(
      		'cedula' => $i,
      		'password' => '$2y$10$KvZZKYWLXkg.jXRaz4RMQ.p96VUi6KGSeQ61SGwNBPA1kPU3x7C1.',
      		'email' => $faker->unique()->email,
             	'nombre' => $faker->name,
             	'organizacion' => $faker->company,
             	'created_at' => date('Y-m-d H:m:s'),
             	'updated_at' => date('Y-m-d H:m:s')
      	));
  		}

    }
}
