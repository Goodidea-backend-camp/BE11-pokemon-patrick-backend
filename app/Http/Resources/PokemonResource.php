<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $skillId = explode(',', $this->skill);
        $skillIds = str_replace(['["', '"]'], '', $skillId);
        $skillIds = str_replace(['"'], '', $skillIds);
        $skills = Skill::whereIn('id', $skillIds)->pluck('name');
        return [
            'name' => $this->name,
            'level' => $this->level,
            'nature' => $this->nature->name,
            'race' => $this->race->name,
            'ability' => $this->ability->name,
            'skill' => $skills,
        ];
    }
}