<?php

namespace Tests\Feature;

use Tests\TestCase;

class NatureIndexTest extends TestCase
{
    public function testNatureIndex(): void
    {
        $response = $this->get('api/natures');

        $response->assertStatus(200);
    }
}
