<?php

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition(): array
    {
        $exchangeRate = 6.96; // BOB to USD
        $priceOwnerUSD = $this->faker->numberBetween(5000, 50000);
        $priceUSD = $priceOwnerUSD * 1.1; // 10% markup
        
        return [
            'description' => $this->faker->sentence(),
            'priceBs' => round($priceUSD * $exchangeRate, 2),
            'priceUSD' => round($priceUSD, 2),
            'pricePerSquareMeterBs' => $this->faker->numberBetween(100, 500),
            'exchangeRate' => $exchangeRate,
            'priceOwnerBs' => round($priceOwnerUSD * $exchangeRate, 2),
            'priceOwnerUSD' => $priceOwnerUSD,
        ];
    }
}