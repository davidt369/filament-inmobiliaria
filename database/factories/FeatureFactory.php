<?php

namespace Database\Factories;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    protected $model = Feature::class;

    public function definition(): array
    {
        return [
            'floors' => $this->faker->numberBetween(1, 4),
            'surfaceArea' => $this->faker->numberBetween(100, 1000),
            'builtArea' => function (array $attributes) {
                return $this->faker->numberBetween(80, $attributes['surfaceArea']);
            },
            'front' => $this->faker->numberBetween(5, 30),
            'details' => $this->faker->paragraphs(3, true),
        ];
    }
}