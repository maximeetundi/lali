<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Shop\OrderResource\Pages;

use App\Filament\Admin\Resources\Shop\OrderResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

/**
 * @property-read \Domain\Shop\Order\Models\Order $record
 */
class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print_invoice')
                ->translateLabel()
                ->icon('heroicon-s-printer')
                ->hidden($this->record->trashed())
                ->url(
                    fn () => route('admin.orders.download.invoice', $this->record),
                    shouldOpenInNewTab: true
                )
                ->authorize('printInvoice'),

            Actions\Action::make('print_receipt')
                ->translateLabel()
                ->icon('heroicon-s-printer')
                ->hidden($this->record->trashed())
                ->action(function () {

                    Notification::make()
                        ->title(trans('Receipt are ready to download!'))
                        ->success()
                        ->send();

                    return $this->record->receipt()->download();
                })
                ->authorize('printReceipt'),

            Actions\DeleteAction::make()
                ->translateLabel(),
            Actions\RestoreAction::make()
                ->translateLabel(),
            Actions\ForceDeleteAction::make()
                ->translateLabel(),
        ];
    }
}
