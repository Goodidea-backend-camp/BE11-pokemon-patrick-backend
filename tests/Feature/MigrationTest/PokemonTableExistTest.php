<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PokemonTableExistTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_pokemons_table_exist(): void
    {   
        Artisan::call('migrate');
    
        $this->assertTrue(Schema::hasTable('pokemons'));
    }
}
