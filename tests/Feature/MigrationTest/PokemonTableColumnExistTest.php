<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PokemonTableColumnExistTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_pokemons_column_exist(): void
    {
        $this->assertTrue(Schema::hasColumn('pokemons', 'name'));
        $this->assertTrue(Schema::hasColumn('pokemons', 'level'));
        $this->assertTrue(Schema::hasColumn('pokemons', 'nature_id'));
        $this->assertTrue(Schema::hasColumn('pokemons', 'race_id'));
        $this->assertTrue(Schema::hasColumn('pokemons', 'ability_id'));
        $this->assertTrue(Schema::hasColumn('pokemons', 'skill'));
    }
}
