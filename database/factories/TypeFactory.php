<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    protected $model = Type::class;

    public function definition(): array
    {
        $types = [
            'House', 'Apartment', 'Land', 'Commercial Space', 'Office',
            'Warehouse', 'Building', 'Country House', 'Cabin', 'Lot',
            'Duplex', 'Chalet', 'Penthouse', 'Studio', 'Villa',
            'Ranch', 'Hacienda', 'Retail Space', 'Industrial Building', 'Condominium'
        ];
        
        return [
            'name' => $this->faker->unique()->randomElement($types),
            'description' => $this->faker->sentence(),
        ];
    }
}