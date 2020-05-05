<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('card_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('round_id');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('round_id')->references('id')->on('rounds')->cascadeOnDelete();
        });
    }
}
