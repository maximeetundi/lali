<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;
use Domain\Site\Asset\Models\Asset;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Logo principal', 'url' => 'https://example.com/logo.png'],
            ['name' => 'Bannière accueil', 'url' => 'https://example.com/banner.jpg'],
        ];

        foreach ($items as $data) {
            Asset::updateOrCreate(
                ['name' => $data['name']],
                ['url' => $data['url']]
            );
        }
    }
}
