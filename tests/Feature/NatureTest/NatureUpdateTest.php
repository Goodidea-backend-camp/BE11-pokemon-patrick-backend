<?php

namespace Tests\Feature;

use App\Models\Nature;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class NatureUpdateTest extends TestCase
{
    use DatabaseMigrations;
       
    public function testNatureUpdate(): void
    {
        Nature::factory()->create();
        $response = $this->put('api/natures/1', ['name' => "躁鬱症"]);

        $response->assertStatus(200);
    }
}