<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Round::class, function (Faker $faker) {
    return [
        'game_id' => factory(App\Game::class),
        'num_cards' => $faker->randomNumber(),
        'active_player_id' => factory(App\User::class),
        'has_started' => $faker->boolean,
        'has_finished' => $faker->boolean,
    ];
});
