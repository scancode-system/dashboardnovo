<?php
namespace Modules\Dashboard\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ShippingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Dashboard\Entities\Shipping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
        ];
    }
}

