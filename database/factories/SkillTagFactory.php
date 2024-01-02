<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SkillTagFactory extends Factory
{

    protected $raceId = 1;
    protected $num = 0;

    public function definition(): array
    {
        $this->num++;
        return [
            'race_id' => $this->raceId,
            'skill_id' => $this->num,
        ];
    }

    public function forRaceId($raceId)
    {
        return $this->state(function (array $attributes) use ($raceId) {
            return [
                'race_id' => $raceId,
            ];
        });
    }
}
