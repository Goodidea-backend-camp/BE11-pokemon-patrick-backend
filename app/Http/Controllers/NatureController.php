<?php

namespace App\Http\Controllers;

use App\Http\Requests\NatureRequest;
use App\Models\Nature;
use Symfony\Component\HttpFoundation\Response;

class NatureController extends Controller
{
    public function store(NatureRequest $request)
    {
        $validatedData = $request->validated();

        $nature = Nature::create($validatedData);
        return response()->json(
            [
                'success' => config('http_success_message.general.created_successfully'),
                'nature' => $nature
            ],
            Response::HTTP_CREATED
        );
    }

    public function index()
    {
        $natures = Nature::all();

        return response()->json(['natures' => $natures], Response::HTTP_OK);
    }

    public function update(NatureRequest $request, $id)
    {
        $validatedData = $request->validated();

        $nature = Nature::find($id);

        if (!$nature) {
            return response()->json(
                ['error' => config('http_error_message.general.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }

        $nature->update($validatedData);

        return response()->json(
            [
                'success' => config('http_success_message.general.updated_successfully'),
                'nature' => $nature
            ],
            Response::HTTP_OK
        );
    }
}