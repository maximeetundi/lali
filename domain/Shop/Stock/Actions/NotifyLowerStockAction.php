<?php

declare(strict_types=1);

namespace Domain\Shop\Stock\Actions;

use Domain\Access\Admin\Models\Admin;
use Domain\Shop\Order\Models\Order;
use Domain\Shop\Order\Notifications\StockWarningNotification;
use Domain\Shop\Stock\Models\SkuStock;
use Illuminate\Database\Eloquent\Builder;

final readonly class NotifyLowerStockAction
{
    public function execute(SkuStock $stock, Order $order): void
    {
        Admin::role(config('domain.access.role.admin'), guard: 'admin')
            ->when($order->admin, function (Builder $query, Admin $admin) {
                $query
                    ->orWhere($admin->getKeyName(), $admin->getKey());
            })
            ->get()
            ->each(
                fn (Admin $admin) => $admin
                    ->notify(
                        new StockWarningNotification($order, $stock)
                    )
            );

    }
}
