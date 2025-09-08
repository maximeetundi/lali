<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Shop\AttributeResource\Pages;

use App\Filament\Admin\Resources\Shop\AttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttributes extends ListRecords
{
    protected static string $resource = AttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
