<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\PartnerResource\Pages;

use App\Filament\Admin\Resources\Site\PartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPartners extends ListRecords
{
    protected static string $resource = PartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
