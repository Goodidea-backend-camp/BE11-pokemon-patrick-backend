<?php

namespace Tests\Feature;

use App\Models\Race;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RaceGetRaceByNameTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testRaceGetRaceByName(): void
    {
        Race::factory()->create(['name'=>'Bulbasaur']);
        
        $response = $this->get('api/races/Bulbasaur');

        $response->assertStatus(200);
    }
}
