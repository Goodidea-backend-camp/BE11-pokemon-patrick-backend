<?php

namespace Tests\Feature;

use App\Models\Ability;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AbilityUpdateTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testAbilityUpdate(): void
    {
        Ability::factory()->create();

        $response = $this->put('api/abilities/1', ['name' => "天賦怪"]);

        $response->assertStatus(200);
    }
}