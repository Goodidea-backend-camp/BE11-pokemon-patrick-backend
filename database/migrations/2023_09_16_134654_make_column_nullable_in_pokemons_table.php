<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pokemons', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('level')->nullable(false)->change();
            $table->string('nature_id')->nullable(false)->change();
            $table->string('race_id')->nullable(false)->change();
            $table->string('ability_id')->nullable(false)->change();
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemons', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('level')->nullable()->change();
            $table->string('nature_id')->nullable()->change();
            $table->string('race_id')->nullable()->change();
            $table->string('ability_id')->nullable()->change();
            //
        });
    }
};