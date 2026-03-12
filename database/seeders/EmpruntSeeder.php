<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Emprunt;
use App\Models\Usager;
use App\Models\Exemplaire;
use Faker\Factory as Faker;

class EmpruntSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $usagers = Usager::pluck('id');
        $exemplaires = Exemplaire::pluck('id');

        for ($i = 0; $i < 250; $i++) {

            $date = $faker->dateTimeBetween('-2 months', 'now');

            Emprunt::create([
                'date_emprunt' => $date,
                'date_retour_prevue' => (clone $date)->modify('+30 days'),
                'date_retour' => null,
                'usager_id' => $faker->randomElement($usagers),
                'exemplaire_id' => $faker->randomElement($exemplaires)
            ]);

        }
    }
}
