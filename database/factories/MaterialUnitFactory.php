<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MaterialUnit;
use Faker\Generator as Faker;

$factory->define(MaterialUnit::class, function (Faker $faker) {
    return [
        'unit' => $faker->randomDigit.$faker->word
    ];
});
