<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;
use Domain\Site\Asset\Models\Asset;
use Domain\Site\Portofolio\Models\Portofolio;
use Domain\Site\Partner\Models\Partner;
use Domain\Site\Text\Models\Text;

class AutoContentSeeder extends Seeder
{
    public function run(): void
    {
        // Try to pick a hero image from Portofolio media, fallback to Partner media
        $heroUrl = null;
        $portMedia = Portofolio::with('media')->get()->flatMap(fn($p) => $p->media);
        if ($portMedia->count() > 0) {
            $heroUrl = $portMedia->first()->getUrl();
        } else {
            $partnerMedia = Partner::with('media')->get()->flatMap(fn($p) => $p->media);
            if ($partnerMedia->count() > 0) {
                $heroUrl = $partnerMedia->first()->getUrl();
            }
        }

        // Stats background can reuse the same or remain empty
        $statsUrl = $heroUrl;

        // Try to find video links in texts by convention keys
        $video1 = Text::query()->where('name', 'video1')->value('fr')
            ?? Text::query()->where('name', 'video')->value('fr')
            ?? null;

        // Upsert Asset entries expected by HomeTrait/getUrlMedia & getUrlLink
        if ($heroUrl) {
            Asset::updateOrCreate(['name' => 'image1'], ['url' => $heroUrl])->save();
        }
        if ($statsUrl) {
            Asset::updateOrCreate(['name' => 'image2'], ['url' => $statsUrl])->save();
        }
        if ($video1) {
            Asset::updateOrCreate(['name' => 'video1'], ['url' => $video1])->save();
        }

        $this->command?->info('AutoContentSeeder: image1/image2/video1 mis à jour si des données étaient disponibles.');
    }
}
