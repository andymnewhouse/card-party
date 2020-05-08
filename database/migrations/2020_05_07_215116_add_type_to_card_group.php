<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToCardGroup extends Migration
{
    public function up()
    {
        Schema::table('card_groups', function (Blueprint $table) {
            $table->string('type')->after('round_id')->nullable();
        });
    }
}
