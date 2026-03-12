<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statut;

class StatutSeeder extends Seeder
{
    public function run(): void
    {
        $statuts = [
            'disponible',
            'emprunté',
            'maintenance'
        ];

        foreach ($statuts as $statut) {
            Statut::create([
                'statut' => $statut
            ]);
        }
    }
}
