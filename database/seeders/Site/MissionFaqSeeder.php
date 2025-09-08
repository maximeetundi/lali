<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;
use Domain\Site\MissionFaq\Models\MissionFaq;
use Domain\Site\MissionFaq\Enums\Status;

class MissionFaqSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Notre mission',
                'fr'   => 'Promouvoir des snacks sains et savoureux.',
                'en'   => 'Promote healthy and tasty snacks.',
                'status' => Status::MISSION->value,
            ],
            [
                'name' => 'Livraison',
                'fr'   => 'Nous livrons sous 48h.',
                'en'   => 'We deliver within 48 hours.',
                'status' => Status::FAQ->value,
            ],
        ];

        foreach ($items as $data) {
            MissionFaq::updateOrCreate(
                ['name' => $data['name']],
                [
                    'fr' => $data['fr'] ?? null,
                    'en' => $data['en'] ?? null,
                    'status' => $data['status'] ?? Status::MISSION,
                ]
            );
        }
    }
}
