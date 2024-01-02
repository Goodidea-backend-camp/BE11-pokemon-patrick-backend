<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PokemonIndexTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testPokemonIndex(): void
    {
        $response = $this->get('/api/pokemons');

        $response->assertStatus(200);
    }
}
