<?php

declare(strict_types=1);

namespace Domain\Site\Partner\Database\Factories;

use Database\Factories\Support\HasMediaFactory;
use Domain\Site\Partner\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Site\Partner\Models\Partner>
 */
class PartnerFactory extends Factory
{
    use HasMediaFactory;

    protected $model = Partner::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'url' => $this->faker->url(),
        ];
    }
}
