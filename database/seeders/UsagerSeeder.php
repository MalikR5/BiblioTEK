<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usager;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsagerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 25; $i++) {
            Usager::create([
                'email' => $faker->unique()->safeEmail(),
                'mdp' => Hash::make('password')
            ]);
        }
    }
}
