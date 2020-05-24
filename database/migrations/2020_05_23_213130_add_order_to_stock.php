<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToStock extends Migration
{
    public function up()
    {
        Schema::table('stock', function (Blueprint $table) {
            $table->unsignedInteger('order')->after('model_type')->nullable();
        });
    }
}
