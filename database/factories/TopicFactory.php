<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(5, true),
        'message' => $faker->text,
        'user_id' => $faker->numberBetween(1, 2)
    ];
});
