<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PokemonFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => 'Luka',
            'level' => '30',
            'nature_id' => 1,
            'race_id' => 1,
            'ability_id' => 1,
            'skill' => "[1 ,2 ,3 ,4]",
        ];
    }
}