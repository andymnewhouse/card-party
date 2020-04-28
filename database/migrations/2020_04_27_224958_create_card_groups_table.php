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
            $table->timestamps();
        });
    }
}
