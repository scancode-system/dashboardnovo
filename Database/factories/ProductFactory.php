<?php
namespace Modules\Dashboard\Database\factories;

use Modules\Dashboard\Entities\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Dashboard\Entities\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->ean13,
            'barcode' => $this->faker->unique()->ean13,
            'description' => $this->faker->company,
            'price' => $this->faker->randomFloat(2, 1, 2000),
            'min_qty' => $this->faker->numberBetween(1,5),
            'discount_limit' => $this->faker->randomFloat(2, 0, 100),
            'multiple' => $this->faker->numberBetween(1,5),
            'product_category_id' => $this->faker->numberBetween(1,10),
        ];
    }
}

