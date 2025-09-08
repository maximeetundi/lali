<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\AssetResource\Pages;

use App\Filament\Admin\Resources\Site\AssetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
