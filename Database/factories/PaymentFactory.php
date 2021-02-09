<?php
namespace Modules\Dashboard\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Dashboard\Entities\Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "description" => $this->faker->unique()->creditCardType,
            "min_value" => $this->faker->numberBetween(0, 2000),
            "discount" => $this->faker->numberBetween(0, 100),
            "addition" => $this->faker->numberBetween(0, 100),
            "visible" => $this->faker->numberBetween(0, 1)
        ];
    }
}