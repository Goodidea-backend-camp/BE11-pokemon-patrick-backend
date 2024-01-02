<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Skill;

class ImportPokemonMoves extends Command
{
    protected $signature = 'import:pokemon-moves';
    protected $description = 'Import all Pokemon moves from API';

    public function handle()
    {
        $response = Http::get('https://pokeapi.co/api/v2/move?limit=918');
        $jsonData = $response->json();

        $movesData = $jsonData['results'];

        foreach ($movesData as $moveData) {
            $moveName = $moveData['name'];

            $existingSkill = Skill::where('name', $moveName)->first();

            if (!$existingSkill) {

                Skill::create(['name' => $moveName]);
            }
        }

        $this->info('Pokemon moves imported successfully.');
    }
}