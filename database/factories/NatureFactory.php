<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class NatureFactory extends Factory
{

    public function definition(): array
    {
        $name = substr($this->faker->unique()->word, 0, 20);

        return [
            'name' => $name,
        ];
    }
}
