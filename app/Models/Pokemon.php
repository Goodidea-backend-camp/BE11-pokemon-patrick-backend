<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokemon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pokemons';

    public function nature()
    {
        return $this->belongsTo(Nature::class, 'nature_id');
    }

    public function ability()
    {
        return $this->belongsTo(Ability::class, 'ability_id');
    }

    public function race()
    {
        return $this->belongsTo(Race::class, 'race_id');
    }

    protected $fillable = [
        'name',
        'level',
        'nature_id',
        'race_id',
        'ability_id',
        'skill',
    ];
}