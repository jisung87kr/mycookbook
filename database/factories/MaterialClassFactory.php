<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MaterialClass;
use Faker\Generator as Faker;

$factory->define(MaterialClass::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
