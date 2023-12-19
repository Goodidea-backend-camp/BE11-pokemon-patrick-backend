<?php

namespace Tests\Feature;

use App\Models\Pokemon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PokemonUpdateTest extends TestCase
{
    use DatabaseMigrations;

    public function testPokemonUpdate(): void
    {
        Pokemon::factory()->create();

        $response = $this->put('api/pokemons/1' , [
            'name' => "西巴誰家",
            'level' => 15,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('pokemons', [
            'name' => "西巴誰家",
            'level' => '15',
        ]);
    }
}
