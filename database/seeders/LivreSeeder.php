<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livre;
use App\Models\Auteur;
use Faker\Factory as Faker;

class LivreSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        $auteurs = Auteur::pluck('id');

        for ($i = 0; $i < 400; $i++) {

            Livre::create([
                'titre' => $faker->sentence(3),
                'auteur_id' => $faker->randomElement($auteurs)
            ]);

        }
    }
}
