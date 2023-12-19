<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    public function skillTags()
    {
        return $this->belongsToMany(Skilltag::class);
    }

    protected $fillable = [
        'name',
    ];
}