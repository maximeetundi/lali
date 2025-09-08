<?php

declare(strict_types=1);

namespace App\Http\Resources\Shop;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property-read \Spatie\Tags\Tag $resource
 */
class TagResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'name' => fn () => $this->resource->name,
        ];
    }
}
