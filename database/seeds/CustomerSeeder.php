<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Customer::class, 5)->create();
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            App\Customer::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail, 
                'phone' =>  rand(0, 1000), 
                'address' =>  Str::random(9), 
                'via' => 'friend',  
                'state' =>  'lahos', 
                'country' =>  'Nigeria'
            ]);
        }
    }
}
