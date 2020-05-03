<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Internship;
use Faker\Generator as Faker;

$factory->define(Internship::class, function (Faker $faker) {
    return [
        'category_id' => $faker->randomElement(\App\InternCategory::all()->pluck('id')->toArray()),
        'place_id' => $faker->randomElement(\App\Place::all()->pluck('id')->toArray()),
        'user_id' => $faker->randomElement(\App\User::all()->pluck('id')->toArray()),
        'title' => $faker->words(3, true),
        'from' => $faker->date(),
        'to' => $faker->date(),
        'hours' => $faker->numberBetween(10, 150),
        'code' => $faker->numberBetween(1000000)
    ];
});
