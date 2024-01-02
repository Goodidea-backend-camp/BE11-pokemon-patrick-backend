<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SkillFactory extends Factory
{

    public function definition(): array
    {
        $name = substr($this->faker->unique()->word, 0, 20);

        return [
            'name' => $name,
        ];
    }
}
