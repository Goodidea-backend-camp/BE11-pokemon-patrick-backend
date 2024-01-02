<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AbilityIndexTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testAbilityIndex(): void
    {
        $response = $this->get('api/abilities');

        $response->assertStatus(200);
    }
}
