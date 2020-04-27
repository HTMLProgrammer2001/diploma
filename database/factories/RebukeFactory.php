<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rebuke;
use Faker\Generator as Faker;

$factory->define(Rebuke::class, function (Faker $faker) {
    return [
        'order' => $faker->numberBetween(1000000),
        'date_presentation' => $faker->date('m/d/Y'),
        'title' => $faker->title,
        'active' => $faker->boolean(75),
        'user_id' => $faker->randomElement(\App\User::all()->pluck('id')->toArray())
    ];
});
