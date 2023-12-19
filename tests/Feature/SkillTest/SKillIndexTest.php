<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SkillIndexTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testSkillIndex(): void
    {
        $response = $this->get('/api/skills');

        $response->assertStatus(200);
    }
}
