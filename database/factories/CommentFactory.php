<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
