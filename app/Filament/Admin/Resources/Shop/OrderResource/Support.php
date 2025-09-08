<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Shop\OrderResource;

use Domain\Shop\Order\Actions\CalculateOrderTotalPriceAction;
use Domain\Shop\Order\DataTransferObjects\ItemWithMinMaxData;

class Support
{
    private function __construct()
    {
    }

    public static function callCalculatorForTotalPrice(array $orderItems): float
    {
        return app(CalculateOrderTotalPriceAction::class)
            ->execute(
                collect($orderItems)
                    ->reject(fn ($data): bool => Support::bank_perso($data))
                    ->map(
                        fn (array $data): ItemWithMinMaxData => new ItemWithMinMaxData(
                            price: $data['price'],
                            quantity: (float) $data['quantity'],
                            minimum: $data['minimum'],
                            maximum: $data['maximum']
                        )
                    )
                    ->toArray()
            )->getAmount();
    }

    public static function bank_perso($data) : bool {
        if (!array_key_exists('sku_id', $data)) {
            return true;
        } else {
            return blank($data['sku_id']);
        }
    }
}
