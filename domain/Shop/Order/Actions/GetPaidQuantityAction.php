<?php

declare(strict_types=1);

namespace Domain\Shop\Order\Actions;

final readonly class GetPaidQuantityAction
{
    public function execute(float|string $quantity1, float|string $quantity2): int|float|string
    {
        return max($quantity1, $quantity2);
    }
}
