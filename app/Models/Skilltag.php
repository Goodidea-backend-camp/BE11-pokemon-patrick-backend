<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skilltag extends Model
{
    use HasFactory;

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skilltag', 'skill_id', 'id');
    }

    public function races()
    {
        return $this->belongsToMany(Race::class, 'skilltag', 'race_id', 'id');
    }
    protected $fillable = [
        'skill_id',
        'race_id',
    ];
    public $timestamps = false;
}