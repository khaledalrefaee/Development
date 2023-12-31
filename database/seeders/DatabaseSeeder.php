<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use DaSeeder;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        $faker = Faker::create();

        for ($i = 0; $i < 8000; $i++) {
            DB::table('data')->insert([
                'id' => $faker->unique()->numberBetween(1, 99999),
                'email' => $faker->unique()->email,
                'created_at' => $faker->dateTimeThisMonth(),
                'updated_at' => now(),
            ]);
        }

        
    }
}
