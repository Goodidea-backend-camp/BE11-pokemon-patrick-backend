<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SkillStoreTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testSkillStore(): void
    {
        $skill = [
            'name' => "肉蛋蔥雞"            
            ];

        $response = $this->post('api/skills', $skill);

        $response->assertStatus(201);
    }
}
