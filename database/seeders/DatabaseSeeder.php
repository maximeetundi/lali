<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Auth\AuthSeeder;
use Database\Seeders\Site\AssetSeeder;
use Database\Seeders\Site\MissionFaqSeeder;
use Database\Seeders\Site\PartnerSeeder;
use Database\Seeders\Site\PortofolioSeeder;
use Database\Seeders\Site\TextSeeder;
use Domain\Shop\Stock\Enums\StockType;
use Domain\Shop\Stock\Models\SkuStock;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Console\OptimizeClearCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Storage::disk(config('media-library.disk_name'))->deleteDirectory('/');

        activity()->disableLogging();

        Mail::fake();
        Notification::fake();

        $this->call([
            AuthSeeder::class,
            AssetSeeder::class,
            MissionFaqSeeder::class,
            PartnerSeeder::class,
            PortofolioSeeder::class,
            TextSeeder::class,
            //BrandSeeder::class,
            //CategorySeeder::class,
            //ProductSeeder::class,
        ]);

        //        if ( ! app()->isProduction()) {
        $this->call([
           // OrderSeeder::class,
            //CustomerSeeder::class,
        ]);
        //        }

        // reset product to base on stock
        // SkuStock::query()->update([
        //     'type' => StockType::BASE_ON_STOCK,
        //     'count' => 10,
        //     'warning' => 7,
        // ]);

        Artisan::call(OptimizeClearCommand::class);
    }
}

