<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UploadTwoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/pokemons', [PokemonController::class, 'store']);
Route::get('/pokemons', [PokemonController::class, 'index']);
Route::get('/pokemons/{id}', [PokemonController::class, 'show']);
Route::put('/pokemons/{id}', [PokemonController::class, 'update']);
Route::delete('/pokemons/{id}', [PokemonController::class, 'destroy']);

Route::post('/natures', [NatureController::class, 'store']);
Route::get('/natures', [NatureController::class, 'index']);
Route::put('/natures/{id}', [NatureController::class, 'update']);

Route::get('/races/{id}/skills', [RaceController::class, 'getSkillsByRaceId']);
Route::get('/races/all', [RaceController::class, 'getAllPokemonRaces']);
Route::get('/races/{name}', [RaceController::class, 'getRaceByName']);
Route::get('/races', [RaceController::class, 'getAllRaces']);

Route::post('/abilities', [AbilityController::class, 'store']);
Route::get('/abilities', [AbilityController::class, 'index']);
Route::put('/abilities/{id}', [AbilityController::class, 'update']);

Route::post('/skills', [SkillController::class, 'store']);
Route::get('/skills', [SkillController::class, 'index']);
Route::put('/skills/{id}', [SkillController::class, 'update']);

Route::post('/upload-Nature-json', [UploadNatureController::class, 'uploadJson']);
Route::post('/upload-Ability-json', [UploadAbilityController::class, 'uploadJson']);