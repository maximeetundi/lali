<?php

declare(strict_types=1);

namespace Domain\Shop\Order\Notifications;

use App\Filament\Admin\Resources\Shop\OrderResource as AdminOrderResource;

use App\Jobs\QueueJobPriority;
use Domain\Access\Admin\Models\Admin;
use Domain\Shop\Order\Models\Order;
use Filament\Facades\Filament;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Filament\Admin\Resources\Shop\OrderResource;

class AdminOrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Order $order,
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
            ->subject(trans('New Order Received [:order]', ['order' => $this->order->receipt_number]))
            ->greeting(trans('Hello :admin!', ['admin' => $notifiable->name]))
            ->line(trans('You have received a new order.'))
            ->line(
                trans(
                    'Order created with price amount :amount',
                    ['amount' => money($this->order->total_price * 100)->format()],
                )
            )
            
            ->when(
                $this->orderResourceUrl($notifiable),
                function (MailMessage $mailMessage, string $url) {
                    $mailMessage
                        ->action(trans('View Order'), $url);
                }
            );
    }

    public function toDatabase(Admin $notifiable): array
    {
        return FilamentNotification::make()
            ->title(trans('New Order Received [:order].', ['order' => $this->order->receipt_number]))
            ->body(
                trans(
                    'Order created with price amount :amount.',
                    ['amount' => money($this->order->total_price * 100)->format()],
                )
            )
            ->icon('heroicon-o-shopping-bag')
            ->when(
                $this->orderResourceUrl($notifiable),
                function (FilamentNotification $notification, string $url) {
                    $notification->actions([
                        Action::make('view_order')
                            ->translateLabel()
                            ->button()
                            ->markAsRead()
                            ->url($url),
                    ]);
                }
            )
            ->getDatabaseMessage();
    }

    private function orderResourceUrl(Admin $admin): ?string
    {
        if ($admin->can('panel.admin') && $admin->can('order.view')) {
            Filament::setCurrentPanel(Filament::getPanel('admin'));

            return AdminOrderResource::getUrl('view', [$this->order]);
        }

        if (! $admin->can('order.view')) {
            return null;
        }

        Auth::setUser($admin);

   

        return OrderResource::getUrl('view', [$this->order]);
    }
}
