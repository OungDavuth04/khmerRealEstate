<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Upload;
use Faker\Generator as Faker;

$factory->define(Upload::class, function (Faker $faker) {
    return [
        'uid' => $faker->randomDigitNotNull,
        'title' => $faker->title,
        'price' => $faker->randomFloat(2, 1000, 10000),
    ];
});
