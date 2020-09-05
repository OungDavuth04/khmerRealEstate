<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Upload_Images;
use Faker\Generator as Faker;

$factory->define(Upload_Images::class, function (Faker $faker) {
    return [
        'UpId' => $faker->unique()->randomFloat(1, 21, 120),
        'image' => 'storage/images/0.40323900.jpeg'
    ];
});
