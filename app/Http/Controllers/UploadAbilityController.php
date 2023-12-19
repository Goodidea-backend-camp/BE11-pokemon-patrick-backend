<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\Ability;
use Symfony\Component\HttpFoundation\Response;

class UploadAbilityController extends Controller
{
    public function uploadJson(UploadRequest $request)
    {
        $jsonFile = $request->file('json_file');

        $jsonData = json_decode(file_get_contents($jsonFile->getPathname()), true);


        foreach ($jsonData["data"]["pokemon_v2_ability"] as $item) {
            $abilityNames = $item["pokemon_v2_abilitynames"];
            if (!empty($abilityNames) && isset($abilityNames[0]['name'])) {
                $abilityName = $abilityNames[0]['name'];
                Ability::create([
                    'name' => $abilityName,
                ]);
            }
        }


        return response()->json(
            ['success' => config('http_success_message.upload.json_file_saved_successfully')],
            Response::HTTP_CREATED
        );
    }
}