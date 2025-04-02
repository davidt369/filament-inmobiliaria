<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'ci' => $this->faker->unique()->numerify('V-########'),
            'property_type' => $this->faker->randomElement(['House', 'Apartment', 'Land', 'Commercial Space', 'Office',
                'Warehouse', 'Building', 'Country House', 'Cabin', 'Lot',
                'Duplex', 'Chalet', 'Penthouse', 'Studio', 'Villa',
                'Ranch', 'Hacienda', 'Retail Space', 'Industrial Building', 'Condominium']),
            'min_price' => $this->faker->numberBetween(10000, 50000),
            'max_price' => $this->faker->numberBetween(51000, 200000),
            'address' => $this->faker->address(),
            'zone' => $this->faker->city(),
            'user_id' => User::factory(),
        ];
    }
}