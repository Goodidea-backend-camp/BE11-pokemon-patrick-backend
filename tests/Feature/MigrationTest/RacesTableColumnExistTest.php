<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RacesTableColumnExistTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_races_column_exist(): void
    {
        $this->assertTrue(Schema::hasColumn('races', 'name'));
    }
}
