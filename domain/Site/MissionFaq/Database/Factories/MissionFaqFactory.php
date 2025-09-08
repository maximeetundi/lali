<?php

declare(strict_types=1);

namespace Domain\Site\MissionFaq\Database\Factories;

use Illuminate\Support\Arr;
use Domain\Site\MissionFaq\Enums\Status;
use Domain\Site\MissionFaq\Models\MissionFaq;
use Database\Factories\Support\HasMediaFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Site\MissionFaq\Models\MissionFaq>
 */
class MissionFaqFactory extends Factory
{
    use HasMediaFactory;

    protected $model = MissionFaq::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'status' => Arr::random(Status::cases()),
            'fr' => $this->faker->unique()->name(),
            'en' => $this->faker->unique()->name(),
        ];
    }
}
