<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Material;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->word,
        'link' => $faker->url
    ];
});
