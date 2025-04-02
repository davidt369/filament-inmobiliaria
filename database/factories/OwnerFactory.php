<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    protected $model = Owner::class;
    private static $idNumber = 1000000;

    public function definition(): array
    {
        return [
            'fullName' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'identityCard' => 'CI-' . (self::$idNumber++),
            'address' => $this->faker->address(),
            'relativePhone' => $this->faker->phoneNumber(),
            'relativeName' => $this->faker->name(),
            'origin' => $this->faker->city(),
            'consignor' => $this->faker->name(),
        ];
    }
}