<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        $lat = $this->faker->latitude();
        $lng = $this->faker->longitude();
        
        return [
            'address' => $this->faker->address(),
            'locationUrl' => "https://maps.google.com/?q={$lat},{$lng}",
            'zone' => $this->faker->city(),
            'seller_location' => $this->faker->address(),
        ];
    }
}