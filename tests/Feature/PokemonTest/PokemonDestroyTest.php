<?php

namespace Tests\Feature;

use App\Models\Pokemon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PokemonDestroyTest extends TestCase
{
    use DatabaseMigrations;

    public function testPokemonDestroy(): void
    {
        Pokemon::factory()->create();
        
        $response = $this->delete('/api/pokemons/1');

        $response->assertStatus(200);

        $this->assertDatabaseHas('pokemons', ['id' => 1]);
    }
}
