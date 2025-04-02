<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $services = [
            'Agua', 'Luz', 'Gas', 'Internet', 'Teléfono', 'Cable TV',
            'Seguridad 24/7', 'Estacionamiento', 'Piscina', 'Gimnasio',
            'Área de juegos', 'Jardín', 'Lavandería', 'Ascensor'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($services),
            'description' => $this->faker->sentence(),
        ];
    }
}