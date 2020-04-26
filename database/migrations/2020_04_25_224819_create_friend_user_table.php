<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendUserTable extends Migration
{
    public function up()
    {
        Schema::create('friend_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('friend_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
