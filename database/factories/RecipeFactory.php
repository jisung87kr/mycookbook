<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
    ];
});
