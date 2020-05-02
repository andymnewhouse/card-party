<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'game_type_id' => factory(App\GameType::class),
        'current_round' => $faker->randomNumber(),
    ];
});
