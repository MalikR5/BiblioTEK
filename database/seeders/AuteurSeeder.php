<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auteur;
use Faker\Factory as Faker;

class AuteurSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            Auteur::create([
                'nom' => $faker->name()
            ]);
        }
    }
}
