<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 500; $i++) {
            DB::table('data')->insert([
                'id' => $faker->unique()->numberBetween(1, 99999),
                'email' => $faker->unique()->email,
                'created_at' => $faker->dateTimeThisMonth(),
                'updated_at' => now(),
            ]);
        }
    }
}
