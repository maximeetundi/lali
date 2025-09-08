<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;
use Domain\Site\Portofolio\Models\Portofolio;

class PortofolioSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Produit Vedette',
                'description' => 'Notre produit phare aux saveurs uniques.'
            ],
            [
                'name' => 'Gamme Bio',
                'description' => 'Une sélection 100% bio.'
            ],
        ];

        foreach ($items as $data) {
            Portofolio::updateOrCreate(
                ['name' => $data['name']],
                ['description' => $data['description']]
            );
        }
    }
}
