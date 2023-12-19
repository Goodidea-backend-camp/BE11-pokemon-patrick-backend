<?php

namespace Tests\Feature;

use App\Models\Ability;
use App\Models\Nature;
use App\Models\Race;
use App\Models\Skill;
use App\Models\Skilltag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PokemonStoreTest extends TestCase
{
    use DatabaseMigrations;

    public function testPokemonStore(): void
    {
        Race::factory()
            ->count(3)
            ->sequence(
                ['name' => 'Bulbasaur'],
                ['name' => 'Ivysaur'],
                ['name' => 'Venusaur'],
            )
            ->create();
        Ability::factory()->count(5)->create();
        Nature::factory()->count(5)->create();
        Skill::factory()->count(5)->create();

        Skilltag::factory()->count(4)->forRaceId(1)->create();
        Skilltag::factory()->count(4)->forRaceId(2)->create();
        Skilltag::factory()->count(4)->forRaceId(3)->create();

        $pokemonData = [
            'name' => 'Luka',
            'level' => '30',
            'nature_id' => 1,
            'race_id' => 1,
            'ability_id' => 1,
            'skill' => [1, 2, 3, 4],
        ];

        $response = $this->post('/api/pokemons', $pokemonData);

        $response->assertStatus(200);
    }
}