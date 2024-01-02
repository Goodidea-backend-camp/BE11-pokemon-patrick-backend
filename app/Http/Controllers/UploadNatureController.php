<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\Nature;
use Symfony\Component\HttpFoundation\Response;

class UploadNatureController extends Controller
{
    public function uploadJson(UploadRequest $request)
    {
        $jsonFile = $request->file('json_file');

        $jsonData = json_decode(file_get_contents($jsonFile->getPathname()), true);

        foreach ($jsonData["data"]["pokemon_v2_naturename"] as $item) {
            Nature::create([
                'name' => $item['name'],
            ]);
        }

        return response()->json(
            ['success' => config('http_success_message.upload.json_file_saved_successfully')],
            Response::HTTP_CREATED
        );
    }

}