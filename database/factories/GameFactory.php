<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'game_type_id' => 1,
        'owner_id' => factory(App\User::class),
        'current_round' => $faker->randomNumber(),
    ];
});
