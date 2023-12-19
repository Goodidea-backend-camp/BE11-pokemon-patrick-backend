<?php

namespace App\Services;

use App\Models\Pokemon;
use App\Models\Race;
use App\Models\Skilltag;
use Illuminate\Support\Facades\Http;

class PokemonService
{
    public function handleSkillLearning($evolution)
    {
        $race = $evolution['race_id'];
        $skillTags = Skilltag::where('race_id', $race)->pluck('skill_id')->all();
        $skill = $evolution['skill'];
        $skill = array_map('intval', $skill);
        $result = judgeSkillLearning($skill, $skillTags);
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }
    public function evolve($data, $id)
    {
        if ($id == false) {
            $targetLevel = $data['level'];
            $raceId = $data['race_id'];
        } else {
            $pokemon = Pokemon::find($id);
            $targetLevel = $data['level'];
            $raceId = $pokemon['race_id'];
        }
        $pokemonApiUrl = "https://pokeapi.co/api/v2/pokemon-species/{$raceId}";
        $response = Http::get($pokemonApiUrl);

        if ($response->successful()) {
            $pokemonSpeciesData = $response->json();
            $evolutionChainUrl = $pokemonSpeciesData['evolution_chain']['url'];

            $evolutionChainResponse = Http::get($evolutionChainUrl)->json();
        }
        if ($evolutionChainResponse == null) {
            return false;
        }
        $chain = $evolutionChainResponse['chain'];
        while (!empty($chain['evolves_to'])) {
            if ($targetLevel >= $chain['evolves_to']['0']['evolution_details']['0']['min_level']) {
                $name = $chain['evolves_to']['0']['species']['name'];
                $evolvedRace = Race::where('name', $name)->first();
                $data['race_id'] = $evolvedRace->id;
            }
            $chain = $chain['evolves_to'][0];
        }
        return $data;
    }
}

?>