<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Roman',
            'Science-fiction',
            'Fantasy',
            'Policier',
            'Histoire',
            'Philosophie',
            'Informatique',
            'Biographie',
            'Jeunesse'
        ];

        foreach ($categories as $categorie) {
            Categorie::create([
                'categorie' => $categorie
            ]);
        }
    }
}
