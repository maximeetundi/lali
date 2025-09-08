<?php

declare(strict_types=1);

namespace Domain\Shop\Cart\DataTransferObjects;

use Domain\Shop\Customer\Models\Customer;

final readonly class CreateCartData
{
    public function __construct(
        public Customer $customer,
        public string $sku_id,
        public float $quantity,
    ) {
    }
}
