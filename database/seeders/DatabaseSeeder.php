<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // $gender = $faker->randomElement(['male', 'female']);

    	// foreach (range(1,150) as $index) {
        //     DB::table('messages')->insert([
        //         'full_name' => $faker->name($gender),
        //         'firm_name' => $faker->name($gender),
        //         'email' => $faker->email,
        //         'phone_number' => $faker->phoneNumber,
        //         'message' => $faker->realText(),
        //     ]);
        // }
    	
        foreach (range(1,10) as $index) {
            DB::table('categories')->insert([
                'parent' => rand(61, 65),
                'name' => $faker->name,
            ]);
        }
        
        

    }
}
