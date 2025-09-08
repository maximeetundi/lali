<?php

declare(strict_types=1);

use App\Settings\SiteSettings;
use Spatie\LaravelSettings\Migrations\SettingsBlueprint;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->inGroup(SiteSettings::group(), function (SettingsBlueprint $blueprint): void {

            $blueprint->add('name', config('app.name'));
            $blueprint->add('favicon', '');
            $blueprint->add('logo', '');
            $blueprint->add('address');

        });
    }
};
