<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('items')->insert([
                'item' => $faker->words(2, true), // generates something like "Cleaning Service"
                'unit_price' => $faker->randomFloat(2, 1000, 5000), // random price between 1000 and 5000
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
