<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //import library faker
        $faker = Faker\Factory::create(); 
        $limit = 5;

        for($i = 0; $i < $limit ; $i++){
        	DB::table('customers')->insert([
        		'fullname' => $faker->name,
        		'email' => $faker->unique()->email,
        		'phone_number' => $faker ->phoneNumber,
        		'address' =>$faker->address,
        	]);
        }

    }
}
