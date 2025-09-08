<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Shop\Order\Models\Order;
use Illuminate\Support\Facades\Gate;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('orders/download')]
class OrderDownloadController
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Exception
     */
    #[Get('{order}/invoice', 'orders.download.invoice')]
    public function invoice(Order $order): mixed
    {
        Gate::authorize('printInvoice', $order);

        $invoice = $order->getFirstMedia('invoice');

        if (null === $invoice) {
            abort(404, trans('Invoice not found.'));
        }

        return $invoice;
    }
}
