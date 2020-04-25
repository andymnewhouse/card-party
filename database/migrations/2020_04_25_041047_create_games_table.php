<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('game_type_id');
            $table->unsignedInteger('num_players');
            $table->json('hands');
            $table->json('players');
            $table->boolean('has_started')->default(false);
            $table->boolean('has_finished')->default(false);
            $table->timestamps();
        });
    }
}
