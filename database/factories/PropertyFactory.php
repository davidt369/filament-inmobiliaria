<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Feature;
use App\Models\Location;
use App\Models\Owner;
use App\Models\Price;
use App\Models\Property;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    private static $propertyNumber = 1000;
    protected $model = Property::class;

    public function definition(): array
    {
        $image_urls = [
            'https://lleca.com.ar/wp-content/uploads/2023/09/lotes-terreno.jpg',
            'https://www.hileia.eco.br/doutor/uploads/2/produtos/2022/09/post-prad-recuperacao-areas-degradadas-jundiai-sp-1663615262189.jpg',
            'https://static-uat.cambiocolombia.com/s3fs-public/2022-08/diseno_sin_titulo_3.png'
        ];

        $seller_images = [
            'https://images.homify.com/images/a_0,c_limit,f_auto,h_1024,q_auto,w_1024/v1587057764/p/photo/image/3433865/render_16/fotos-de-casas-multifamiliares-de-estilo-moderno-de-mutations-architecture.jpg',
            'https://i.pinimg.com/original/02/8d/75/028d757891318c5b58325ba94782e20e.jpg'
        ];

        // Get random models to ensure proper slug generation
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();
        $type = Type::inRandomOrder()->first() ?? Type::factory()->create();
        $price = Price::inRandomOrder()->first() ?? Price::factory()->create();

        return [
            'status' => $this->faker->randomElement(['available', 'sold', 'rented', 'processing', 'expired']),
            'code' => 'PROP-' . (self::$propertyNumber++),
            'image_urls' => json_encode($image_urls),
            'seller_images' => json_encode($seller_images),
            'is_offer' => $this->faker->boolean(20),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'category_id' => $category->id,
            'type_id' => $type->id,
            'owner_id' => Owner::factory(),
            'price_id' => $price->id,
            'location_id' => Location::factory(),
            'feature_id' => Feature::factory(),
        ];
    }
}