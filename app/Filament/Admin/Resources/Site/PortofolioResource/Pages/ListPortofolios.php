<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\PortofolioResource\Pages;

use App\Filament\Admin\Resources\Site\PortofolioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortofolios extends ListRecords
{
    protected static string $resource = PortofolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
