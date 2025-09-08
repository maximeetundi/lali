<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Access\AdminResource\RelationManagers;

use App\Filament\Admin\Resources\Access\ActivityResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CauserRelationManager extends RelationManager
{
    protected static string $relationship = 'causerActivities';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return ActivityResource::form($form);
    }

    public function table(Table $table): Table
    {
        return (new \App\Filament\Admin\Resources\Access\ActivityResource\RelationManagers\ActivitiesRelationManager())->table($table);
    }

    protected function canCreate(): bool
    {
        return false;
    }

    protected function canEdit(Model $record): bool
    {
        return false;
    }

    protected function canDelete(Model $record): bool
    {
        return false;
    }
}
