<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\PortofolioResource\Pages;

use App\Filament\Admin\Resources\Site\PortofolioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortofolio extends EditRecord
{
    protected static string $resource = PortofolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->translateLabel(),
            Actions\RestoreAction::make()
                ->translateLabel(),
            Actions\ForceDeleteAction::make()
                ->translateLabel(),
        ];
    }
}
