<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Access\AdminResource\RelationManagers;

use App\Filament\Admin\Resources\Shop\OrderResource;
use Exception;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'receipt_number';

    public function form(Form $form): Form
    {
        return OrderResource::form($form, withAdmin: false);
    }

    /** @throws Exception */
    public function table(Table $table): Table
    {
        return OrderResource::table($table, withAdmin: false);
    }
}
