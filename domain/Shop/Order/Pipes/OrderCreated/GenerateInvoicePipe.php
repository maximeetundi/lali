<?php

declare(strict_types=1);

namespace Domain\Shop\Order\Pipes\OrderCreated;

use Domain\Shop\Order\Actions\OrderInvoiceAction;
use Domain\Shop\Order\DataTransferObjects\OrderPipelineData;
use Illuminate\Support\Facades\Storage;

readonly class GenerateInvoicePipe
{
    public function __construct(private OrderInvoiceAction $orderInvoiceAction)
    {
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     */
    public function handle(OrderPipelineData $orderPipelineData, callable $next): OrderPipelineData
    {

        $invoice = $this->orderInvoiceAction->execute($orderPipelineData->order);

        $invoice->save();

        $orderPipelineData->order
            ->addMedia(
                Storage::disk(
                    empty($invoice->disk)
                        ? null
                        : $invoice->disk
                )
                    ->path($invoice->filename)
            )
            ->toMediaCollection('invoice');

        return $next($orderPipelineData);
    }
}
