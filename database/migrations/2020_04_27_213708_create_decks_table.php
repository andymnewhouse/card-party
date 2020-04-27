<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecksTable extends Migration
{
    public function up()
    {
        Schema::create('decks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('round_id');
            $table->unsignedInteger('card_id');
            $table->string('location');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
