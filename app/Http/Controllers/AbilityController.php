<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbilityRequest;
use App\Models\Ability;
use Symfony\Component\HttpFoundation\Response;

class AbilityController extends Controller
{
    public function store(AbilityRequest $request)
    {
        try {
            $ability = Ability::create([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'success' => config('http_success_message.general.created_successfully'),
                'Ability' => $ability
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => config('http_error_message.general.error_creating')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function index()
    {
        try {
            $abilities = Ability::all();

            return response()->json(['data' => $abilities], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => config('http_error_message.general.error_fetching')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function update(AbilityRequest $request, $id)
    {
        try {
            $ability = Ability::findOrFail($id);

            $ability->update([
                'name' => $request->input('name'),
            ]);

            $updatedAbility = Ability::find($id);

            return response()->json([
                'error' => config('http_success_message.general.updated_successfully'),
                'Ability' => $updatedAbility
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => config('http_error_message.general.error_updating')],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}