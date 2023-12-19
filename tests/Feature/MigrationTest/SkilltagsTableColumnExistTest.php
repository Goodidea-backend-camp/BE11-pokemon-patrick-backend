<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SkilltagsTableColumnExistTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_skilltags_column_exist(): void
    {
        $this->assertTrue(Schema::hasColumn('skilltags', 'race_id'));
        $this->assertTrue(Schema::hasColumn('skilltags', 'skill_id'));
    }
}
