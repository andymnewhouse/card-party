<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Stock::class, function (Faker $faker) {
    return [
        'round_id' => factory(App\Round::class),
        'card_id' => $faker->randomNumber(),
        'location' => $faker->word,
        'model_id' => $faker->randomNumber(),
        'model_type' => $faker->word,
        'cards_id' => factory(App\Card::class),
    ];
});
