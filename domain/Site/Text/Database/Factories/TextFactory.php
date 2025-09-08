<?php

declare(strict_types=1);

namespace Domain\Site\Text\Database\Factories;

use Database\Factories\Support\HasMediaFactory;
use Domain\Site\Text\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Site\Text\Models\Text>
 */
class TextFactory extends Factory
{
    use HasMediaFactory;

    protected $model = Text::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'url' => $this->faker->url(),
            'fr' => $this->faker->unique()->name(),
            'en' => $this->faker->unique()->name(),
            'fr_l' => $this->faker->unique()->name(),
            'en_l' => $this->faker->unique()->name(),
        ];
    }
}
