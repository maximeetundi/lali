<?php

declare(strict_types=1);

namespace Domain\Site\Asset\Database\Factories;

use Database\Factories\Support\HasMediaFactory;
use Domain\Site\Asset\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Site\Asset\Models\Asset>
 */
class AssetFactory extends Factory
{
    use HasMediaFactory;

    protected $model = Asset::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'url' => $this->faker->url(),
        ];
    }
}
