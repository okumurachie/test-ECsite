<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();
        return [
            'user_id' => 1,
            'name' => $name,
            'price' => $this->faker->numberBetween(100, 10000),
            'stock' => $this->faker->numberBetween(0, 50),
            'image' => 'https://placehold.jp/640x480.png?text=' . $name,
            'description' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
