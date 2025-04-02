<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = [
          'For Sale', 'For Rent', 'In Anticretico', 'In Exchange',
'For Pre-Sale', 'Under Construction', 'In Project', 'In Liquidation',
'At Auction', 'In Judicial Liquidation',
'In Extrajudicial Liquidation', 'In Administrative Liquidation',

         
        ];
        
        return [
            'name' => $this->faker->unique()->randomElement($categories),
            'description' => $this->faker->sentence(),
        ];
    }
}