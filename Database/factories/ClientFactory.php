<?php
namespace Modules\Dashboard\Database\factories;

use Modules\Dashboard\Entities\Client;
use Illuminate\Database\Eloquent\Factories\Factory;


class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'corporate_name' => $this->faker->unique()->company,
            'fantasy_name' => $this->faker->company,
            'cpf_cnpj' => $this->faker->unique()->numerify('#########'),
            'buyer' => $this->faker->titleMale ,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber 
        ];
    }
}

