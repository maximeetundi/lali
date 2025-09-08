<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\TextResource\Pages;

use App\Filament\Admin\Resources\Site\TextResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTexts extends ListRecords
{
    protected static string $resource = TextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
