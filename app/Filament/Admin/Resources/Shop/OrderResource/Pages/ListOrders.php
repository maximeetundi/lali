<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Shop\OrderResource\Pages;

use App\Filament\Admin\Resources\Shop\OrderResource;
use App\Filament\Admin\Resources\Shop\OrderResource\Widgets\TotalOrders;
use Domain\Shop\Order\Enums\Status;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->translateLabel(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TotalOrders::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make(trans('All')),
            ...collect(Status::cases())
                ->mapWithKeys(
                    fn (Status $status) => [
                        $status->value => Tab::make($status->value)
                            ->query(fn ($query) => $query->where('status', $status))
                            ->label($status->getLabel())
                            ->icon($status->getIcon()),
                    ]
                )
                ->toArray(),
        ];
    }
}
