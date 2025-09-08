<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;
use Domain\Site\Text\Models\Text;

class TextSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'hero_title',
                'fr'   => 'Savourez des Snacks Délicieux et Sains',
                'en'   => 'Enjoy Your Healthy Delicious Snacks',
                'fr_l' => 'Des ingrédients de qualité et un savoir-faire unique.',
                'en_l' => 'Quality ingredients and unique know-how.',
            ],
            [
                'name' => 'contact_phone',
                'fr'   => '+237 678 805 224',
                'en'   => '+237 678 805 224',
                'fr_l' => null,
                'en_l' => null,
            ],
        ];

        foreach ($items as $data) {
            Text::updateOrCreate(
                ['name' => $data['name']],
                [
                    'fr'   => $data['fr'] ?? null,
                    'en'   => $data['en'] ?? null,
                    'fr_l' => $data['fr_l'] ?? null,
                    'en_l' => $data['en_l'] ?? null,
                ]
            );
        }
    }
}
