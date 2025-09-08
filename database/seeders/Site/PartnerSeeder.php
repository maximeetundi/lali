<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;
use Domain\Site\Partner\Models\Partner;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Partenaire A', 'url' => 'https://example.com/partner-a'],
            ['name' => 'Partenaire B', 'url' => 'https://example.com/partner-b'],
        ];

        foreach ($items as $data) {
            Partner::updateOrCreate(
                ['name' => $data['name']],
                ['url' => $data['url']]
            );
        }
    }
}
