<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UploadAbilityController;
use App\Http\Controllers\UploadNatureController;
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

Route::middleware('jwt')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/logout', [AuthController::class, 'logout']);
    
    // 例如，获取好友列表
    Route::get('/get-friends', [FriendshipController::class, 'getFriends']);

    // 发送好友邀请
    Route::post('/send-friend-request/{recipient}', [FriendshipController::class, 'sendFriendRequest']);

    // 接受好友邀请
    Route::post('/accept-friend-request', [FriendshipController::class, 'acceptFriendRequest']);

    // 拒絕好友邀請
    Route::post('/reject-friend-request', [FriendshipController::class, 'rejectFriendRequest']);

    // 删除好友
    Route::delete('/remove-friend/{friend}', [FriendshipController::class, 'removeFriend']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

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

