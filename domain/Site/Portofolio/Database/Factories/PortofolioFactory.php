<?php

declare(strict_types=1);

namespace Domain\Site\Portofolio\Database\Factories;

use Database\Factories\Support\HasMediaFactory;
use Domain\Site\Portofolio\Models\Portofolio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Site\Portofolio\Models\Portofolio>
 */
class PortofolioFactory extends Factory
{
    use HasMediaFactory;

    protected $model = Portofolio::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->url(),
        ];
    }
}
