<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundsTable extends Migration
{
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedInteger('num_cards');
            $table->unsignedBigInteger('active_player_id');
            $table->json('goals')->nullable();
            $table->boolean('has_started')->default(false);
            $table->boolean('has_finished')->default(false);
            $table->json('scores')->nullable();
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('active_player_id')->references('id')->on('users');
        });
    }
}
