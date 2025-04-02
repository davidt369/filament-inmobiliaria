<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('-1 month', 'now');
        $endTime = $this->faker->dateTimeBetween($startTime, '+2 days');

        return [
            'activity' => $this->faker->sentence(),
            'seller' => $this->faker->name(),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'user_id' => User::factory(),
        ];
    }
}