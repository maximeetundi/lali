<?php

declare(strict_types=1);

namespace Domain\Shop\Order\Observers;

use App\Observers\LogAttemptDeleteResource;
use Domain\Shop\Order\Actions\GenerateReceiptNumberAction;
use Domain\Shop\Order\Models\Order;
use Filament\Facades\Filament;

class OrderObserver
{
    use LogAttemptDeleteResource;

    public function creating(Order $order): void
    {
        $order->receipt_number = app(GenerateReceiptNumberAction::class)->execute($order);

        if (Filament::auth()->check()) {
            $order->admin()->associate(Filament::auth()->user());
        }
    }
}
