<?php

declare(strict_types=1);

namespace App\Http\Resources\Shop;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property-read \Domain\Shop\Product\Models\AttributeOption $resource
 */
class AttributeOptionResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'value' => $this->resource->value,
        ];
    }

    /** @return array<string, callable> */
    public function toRelationships(Request $request): array
    {
        return [
            'attribute' => fn () => AttributeResource::make($this->resource->attribute),
        ];
    }
}
