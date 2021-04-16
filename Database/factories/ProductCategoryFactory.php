<?php
namespace Modules\Dashboard\Database\factories;

use Modules\Dashboard\Entities\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Dashboard\Entities\ProductCategory;

class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
        ];
    }
}

