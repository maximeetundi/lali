<?php

declare(strict_types=1);

namespace Domain\Shop\Order\Notifications;

use Illuminate\Bus\Queueable;
use App\Jobs\QueueJobPriority;
use Filament\Facades\Filament;
use Domain\Shop\Order\Models\Order;
use Illuminate\Support\Facades\Auth;
use Domain\Access\Admin\Models\Admin;
use Domain\Shop\Stock\Models\SkuStock;
use Filament\Notifications\Actions\Action;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Filament\Admin\Resources\Shop\ProductResource;
use Filament\Notifications\Notification as FilamentNotification;
use App\Filament\Admin\Resources\Shop\ProductResource as AdminProductResource;

class StockWarningNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Order $order,
        private readonly SkuStock $skuStock,
    ) {
        $this->queue = QueueJobPriority::HIGH;
    }

    public function via(Admin $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(Admin $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject(trans('Sku [:sku_code] Stock Warning', ['sku_code' => $this->skuStock->sku->code]))
            ->greeting(trans('Hello :admin!', ['admin' => $notifiable->name]))
            ->line(
                trans(
                    'Sku [:sku_code] has only [:stock_count] available stock, after order [:order] created.',
                    [
                        'sku_code' => $this->skuStock->sku->code,
                        'stock_count' => $this->skuStock->count ?? 'n/a',
                        'order' => $this->order->receipt_number,
                    ]
                )
            )
            ->when(
                $this->orderProductUrl($notifiable),
                function (MailMessage $mailMessage, string $url) {
                    $mailMessage
                        ->action(trans('View Product'), $url);
                }
            );
    }

    public function toDatabase(Admin $notifiable): array
    {
        return FilamentNotification::make()
            ->title(trans('Sku [:sku_code] Stock Warning.', ['sku_code' => $this->skuStock->sku->code]))
            ->body(
                trans(
                    'Sku [:sku_code] has only [:stock_count] available stock, after order [:order] created.',
                    [
                        'sku_code' => $this->skuStock->sku->code,
                        'stock_count' => $this->skuStock->count ?? 'n/a',
                        'order' => $this->order->receipt_number,
                    ]
                )
            )
            ->icon('heroicon-o-exclamation-circle')
            ->when(
                $this->orderProductUrl($notifiable),
                function (FilamentNotification $notification, string $url) {
                    $notification
                        ->actions([
                            Action::make('view_sku_stock')
                                ->translateLabel()
                                ->button()
                                ->markAsRead()
                                ->url($url),
                        ]);
                }
            )
            ->getDatabaseMessage();
    }

    private function orderProductUrl(Admin $admin): ?string
    {
        if ($admin->can('panel.admin') && $admin->can('product.update')) {
            Filament::setCurrentPanel(Filament::getPanel('admin'));

            return AdminProductResource::getUrl('edit', [$this->skuStock->sku->product]);
        }

        if (! $admin->can('product.update')) {
            return null;
        }

        Auth::setUser($admin);


        return ProductResource::getUrl('edit', [$this->skuStock->sku->product]);
    }
}
