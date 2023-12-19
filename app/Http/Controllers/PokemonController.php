<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonStoreRequest;
use App\Http\Requests\PokemonUpdateRequest;
use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use App\Models\Skilltag;
use App\Services\PokemonService;
use Symfony\Component\HttpFoundation\Response;

class PokemonController extends Controller
{
    public $evolutionAndLearnSkill;

    public function __construct(PokemonService $evolutionAndLearnSkill)
    {
        $this->evolutionAndLearnSkill = $evolutionAndLearnSkill;
    }
    public function store(PokemonStoreRequest $request)
    {
        $data = $request->validated();

        $evolution = $this->evolutionAndLearnSkill->evolve($data, false);

        $validator = $this->evolutionAndLearnSkill->handleSkillLearning($evolution);

        if ($validator == false) {

            return response()->json(
                ['error' => config('http_error_message.general.pokémon_cannot_learn_these_skills')],
                Response::HTTP_BAD_REQUEST
            );
        }

        $evolution['skill'] = json_encode($evolution['skill']);

        $evolution['skill'] = json_encode($evolution['skill']);

        $pokemon = Pokemon::create($evolution);

        return [
            'success' => config('http_success_message.general.created_successfully'),
            'pokemons' => $pokemon,
            Response::HTTP_CREATED
        ];

    }

    public function index()
    {
        $pokemons = Pokemon::all();

        return PokemonResource::collection($pokemons);
    }

    public function show($id)
    {
        $pokemon = Pokemon::with('nature', 'race', 'ability')->find($id);
        if (!$pokemon) {
            return response()->json(
                ['error' => config('http_error_message.general.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }

        return PokemonResource::make($pokemon);
    }

    public function update(PokemonUpdateRequest $request, $id)
    {
        $pokemon = Pokemon::find($id);
        $data = $request->validated();
        if (!$pokemon) {
            return response()->json(
                ['error' => config('http_error_message.general.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }
        if ($request->has('level')) {
            $this->evolutionAndLearnSkill->evolve($data, $id);
        }

        if ($request->has('skill')) {
            $race = $pokemon->race_id;
            $skillTags = SkillTag::where('race_id', $race)->pluck('skill_id')->all();
            $skill = $data['skill'];
            $skill = array_map('intval', $skill);

            $result = judgeSkillLearning($skill, $skillTags);
            if ($result == false) {
                return response()->json(
                    ['error' => config('http_error_message.general.pokémon_cannot_learn_these_skills')],
                    Response::HTTP_BAD_REQUEST
                );
            }
        }

        $pokemon->update($request->validated());

        return response()->json(
            [
                'success' => config('http_success_message.general.updated_successfully'),
                'pokemon' => $pokemon
            ],
            Response::HTTP_OK
        );
    }

    public function destroy($id)
    {
        $pokemon = Pokemon::find($id);

        if (!$pokemon) {
            return response()->json(
                ['error' => config('http_error_message.general.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }

        $deleted = $pokemon->delete();

        return response()->json(
            ['success' => config('http_success_message.general.deleted_successfully')],
            Response::HTTP_OK
        );
    }
}