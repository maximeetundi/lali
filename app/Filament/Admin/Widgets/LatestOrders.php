<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Domain\Shop\Order\Models\Order;
use Domain\Access\Role\PermissionWidgets;
use App\Filament\Admin\Support\TenantHelper;
use App\Filament\Admin\Resources\Shop\OrderResource;
use Domain\Access\Role\Contracts\HasPermissionWidgets;
use App\Filament\Admin\Resources\Shop\OrderResource as MainOrderResourceAlias;
use App\Filament\Branch\Resources\Shop\OrderResource as BranchOrderResourceAlias;
use Illuminate\Contracts\Support\Htmlable;

class LatestOrders extends TableWidget implements HasPermissionWidgets
{
    use PermissionWidgets;

    protected static ?int $sort = 7;

    protected function getTableHeading(): string | Htmlable | null
    {
        return __('Latest Orders');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::limit(5)->latest())
            ->columns([
                Tables\Columns\TextColumn::make('customer.full_name')
                    ->translateLabel(),

                Tables\Columns\TextColumn::make('total_price')
                    ->translateLabel()
                    ->money(),

                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->translateLabel()
                    ->authorize('view')
                    ->url(fn (Order $record): string => match (null) {
                        true => MainOrderResourceAlias::getUrl('view', ['record' => $record]),
                        default => OrderResource::getUrl('view', ['record' => $record]),
                    }),
            ])
            ->paginated(false);
    }
}
