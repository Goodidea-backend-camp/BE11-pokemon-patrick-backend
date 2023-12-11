<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RaceGetAllRaceTest extends TestCase
{
    use DatabaseMigrations;

    public function test_example(): void
    {
        $response = $this->get('/api/races');

        $response->assertStatus(200);
    }
}
