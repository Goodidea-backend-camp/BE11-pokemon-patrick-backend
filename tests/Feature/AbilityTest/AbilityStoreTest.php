<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AbilityStoreTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testAbilityStore(): void
    {
        $ability = [
            'name' => "超強新秀"
        ];

        $response = $this->post('api/abilities', $ability);
        $response->assertStatus(201);
    }
}