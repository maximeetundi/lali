<?php

declare(strict_types=1);

namespace Domain\Shop\Stock\Rules;

use Closure;

use Domain\Shop\Product\Enums\Status;
use Domain\Shop\Product\Models\Sku;
use Domain\Shop\Stock\Enums\StockType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Relations\HasMany;

readonly class CheckQuantitySkuStockRule implements ValidationRule
{
    private ?Sku $skuModel;

    public function __construct(
        Sku|string|int $sku,
        string $skuColumn = 'id',
    ) {
        $query = $sku instanceof Sku
            ? Sku::whereKey($sku)
            : Sku::where($skuColumn, $sku);

        $this->skuModel = $query
            ->whereRelation('product', 'status', Status::IN_STOCK)
            ->with([
                'skuStocks'
            ])
            ->first();
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $quantity = (float) $value;
        unset($value);

        $skuStock = $this->skuModel?->skuStocks[0] ?? null;

        if (null === $skuStock) {
            $fail(trans('Sku stock not ready.'));

            return;
        }

        if (StockType::UNLIMITED === $skuStock->type) {
            return;
        }

        if (StockType::UNAVAILABLE === $skuStock->type) {
            $fail(trans('Sku stock is not available.'));

            return;
        }

        if (StockType::BASE_ON_STOCK === $skuStock->type && $quantity > $skuStock->count) {
            /** @var int $count */
            $count = $skuStock->count;
            $fail(trans('Sku Stock is insufficient, available: :count.', ['count' => $count]));

            return;
        }
    }
}
