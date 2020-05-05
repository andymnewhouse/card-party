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
            $table->unsignedBigInteger('owner_id');
            $table->unsignedInteger('current_round')->default(0);
            $table->timestamps();
        });
    }
}
