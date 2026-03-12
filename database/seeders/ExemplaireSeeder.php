<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exemplaire;
use App\Models\Livre;
use Faker\Factory as Faker;

class ExemplaireSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $livres = Livre::pluck('id');

        for ($i = 0; $i < 1500; $i++) {

            Exemplaire::create([
                'mise_en_service' => $faker->date(),
                'livre_id' => $faker->randomElement($livres),
                'statut_id' => 1
            ]);

        }
    }
}
