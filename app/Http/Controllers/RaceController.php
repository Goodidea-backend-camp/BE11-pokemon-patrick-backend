<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use App\Models\Skill;
use App\Models\Skilltag;
use Symfony\Component\HttpFoundation\Response;

class RaceController extends Controller
{
    public function getRaceByName(Request $request, $name)
    {
        $race = Race::where('name', $name)->first();

        if (!$race) {
            return response()->json(
                ['error' => config('http_error_message.general.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json(['race' => $race->name], Response::HTTP_OK);
    }
    public function getAllRaces(Request $request)
    {
        try {
            $races = Race::all();

            return response()->json(['races' => $races], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => config('http_error_message.general.error_fetching')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getAllPokemonRaces(Request $request)
    {

        $races = Race::all()->pluck('name');

        return response()->json(
            ['races' => $races], Response::HTTP_OK
        );
    }

    public function getSkillsByRaceId(Request $request, $id)
    {
        $race = Race::find($id);

        if (!$race) {
            return response()->json(
                ['error' => config('http_error_message.general.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }
        $raceId = $race->id;
        $skillTags = SkillTag::where('race_id', $raceId)->get();

        $skillData = [];

        foreach ($skillTags as $skillTag) {
            $skillId = $skillTag->skill_id;
            $show = Skill::find($skillId);
            $skillName = $show->name;
            $skillData[$skillId] = $skillName;
        }

        ksort($skillData);

        return response()->json(['skill_data' => $skillData]);
    }
}