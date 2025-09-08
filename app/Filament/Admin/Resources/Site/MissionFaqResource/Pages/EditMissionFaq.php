<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\MissionFaqResource\Pages;

use App\Filament\Admin\Resources\Site\MissionFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMissionFaq extends EditRecord
{
    protected static string $resource = MissionFaqResource::class;

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
