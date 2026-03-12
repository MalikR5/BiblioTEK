<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatutSeeder::class,
            CategorieSeeder::class,
            AuteurSeeder::class,
            UsagerSeeder::class,
            LivreSeeder::class,
            ExemplaireSeeder::class,
            EmpruntSeeder::class,
        ]);
    }
}
